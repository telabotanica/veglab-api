<?php

namespace App\Controller;

use App\Form\OccurrenceType;
use App\Utils\ArrayToOccurrenceTransformer;
use App\Utils\ElasticsearchClient;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Imports Occurrence resources by uploading a spreadsheet file (CSV or excel).
 *
 * @internal Wrapped into an SQL transaction.
 * @package App\Controller
 */
final class ImportOccurrenceAction {

    private $validator;
    private $doctrine;
    private $tokenStorage;
    private $tmpFolder;
    protected $esClient;

    // All of a sudden, symfony $file->getMimeType() started to return twice 
    // the mime-type.. Investigate this...
    const FILE_MIME_TYPES = array(
        'text/x-comma-separated-values', 'text/comma-separated-values', 
        'application/octet-stream', 'application/vnd.ms-excel', 
        'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 
        'application/excel', 'application/vnd.msexcel', 'text/plain', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/x-comma-separated-valuestext/x-comma-separated-values', 'text/comma-separated-valuestext/comma-separated-values', 
        'application/octet-streamapplication/octet-stream', 'application/vnd.ms-excelapplication/vnd.ms-excel', 
        'application/x-csvapplication/x-csv', 'text/x-csvtext/x-csv', 'text/csvtext/csv', 'application/csvapplication/csv', 
        'application/excelapplication/excel', 'application/vnd.msexcelapplication/vnd.msexcel', 'text/plaintext/plain', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheetapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    const UNREGISTERED_SECURITY_BUNDLE_MSG = 'The SecurityBundle is not ' .
        'registered in your application.';
    const IMPORT_OK_POSSIBLE_DUPLICATE_MSG = 'Occurrence succesfully ' . 
        'imported. Warining: possible duplicate already exists in DB. ' .
        'Observation importée avec succès. Attention toutefois : un doublon' .
        ' existe dans le carnet. Line/ligne: ';
    const IMPORT_OK = 'Occurrence succesfully imported. Observation importée' .
        ' avec succès. Line/ligne:';
    const REQUEST_FILE_NAME = 'file';

    /**
     * Returns a new <code>ImportOccurrenceAction</code> instance 
     * initialized with (injected) services.
     *
     * @param TokenStorageInterface $tokenStorage The injected 
     *        <code>TokenStorageInterface</code> service.
     * @param ValidatorInterface $validator The injected 
     *        <code>ValidatorInterface</code> service.
     * @param ManagerRegistry $doctrine The injected 
     *        <code>ManagerRegistry</code> service.
     * 
     * @return ImportOccurrenceAction Returns a new  
     *         <code>ImportOccurrenceAction</code> instance initialized 
     *         with (injected) services passed as parameters.
     */
    public function __construct(
        TokenStorageInterface $tokenStorage, ManagerRegistry $doctrine, 
        ValidatorInterface $validator) {

	$this->tokenStorage = $tokenStorage;
        $this->validator = $validator;
        $this->doctrine = $doctrine;
        $this->tmpFolder = getenv('TMP_FOLDER');
    }

    /**
     * Returns an array containing the data from a spreadsheet file active
     * sheet.
     *
     * @param File $file The spreadsheet file (csv or excel) to extract the
     *        data from. 
     * 
     * @return array Returns an array containing the data from a spreadsheet
     *         file activesheet.
     */
    public function extractArrayFromSpreadsheet($file): array {
//die($file->getMimeType());

//echo in_array($file->getMimeType(),ImportOccurrenceAction::FILE_MIME_TYPES);
 
        if ( in_array(
                $file->getMimeType(), 
                ImportOccurrenceAction::FILE_MIME_TYPES) ) {
            $extension = $file->getClientOriginalExtension();
         
            // @todo use an elvis operator here
            if('csv' == $extension) {
                $reader = new Csv();
            } else {
                $reader = new Xlsx();
            }
	    // @refactor streaming the result would be far nicer
	    $reader->setReadDataOnly(true);
            $fileOriginalName = $file->getClientOriginalName();
	        $file->move($this->tmpFolder, $fileOriginalName);
            $spreadsheet = $reader->load(
                $this->tmpFolder . '/' . $fileOriginalName);          
            return $spreadsheet->getActiveSheet()->toArray();
        }
        // @refactor: throw a custom exception
        return null;
    }

    /**
     * Invokes the controller/action.
     *
     * @param Request $request The HTTP <code>Request</code> issued 
     *        by the client.
     * 
     * @return Response Returns an HTTP <code>Response</code> reflecting
     *         the action result.
     */
    /*
     * @refactor: the connection is flushed AFTER EACH INSERT to allow to
     * retrieve the newly created occ id... nice for feedbacks, sucks big
     * time for performances... @todo insert idless messages in $jsonResp
     * and update $jsonResp with ids afterward after the periodical flush.
     * @perf @todo: optimize this...
     */
    public function __invoke(Request $request): Response {

        $em = $this->doctrine->getManager();
		$occRepo = $em->getRepository('App\Entity\Occurrence');
    	$user = $this->getUser();
        $reqFiles = $request->files;
        $file = $reqFiles->get(ImportOccurrenceAction::REQUEST_FILE_NAME);
        $occArray = $this->extractArrayFromSpreadsheet($file);
        if ( null === $occArray ) {
        	$jsonResp = new Response(
                json_encode($jsonResp), Response::HTTP_UNPROCESSABLE_ENTITY, []);
        }
        else {
            $occTransformer = new ArrayToOccurrenceTransformer($this->doctrine);
            // Isolate the import in a transaction to allow rollbacking the INSERTs
            // in case an Exception occurs so the DB isn't left in a messy state.
            $em->getConnection()->beginTransaction();
            $jsonResp = array();
            $occCount = 0;
            $persistedOccIds = array();

            try {
                foreach( $occArray as $occAsArray ) {
                    $occCount++;
                    $occ = $occTransformer->transform($occAsArray, $user);

		            if ( null !== $occ) {
                            
			            if ( $errors = $this->validator->validate($occ) ) {
                    		// persist the occurrence and associated photos  
	                        // alongside (consequently updating elasticsearch 
                            // 'photos' index):
	                        $em->persist($occ);	
			                $em->flush();
                            $persistedOccIds[] = $occ->getId();

			                // Look for duplicate occurrences (same signature):
			                $occ->generateSignature($user->getId());
			                $sign = $occ->getSignature();
			                $duplicates = $occRepo->findBySignature($sign, $user);

			                // If there is, at least, one duplicate, return null:
			                if ( sizeof($duplicates)>0 ) {
                                $msg = ImportOccurrenceAction::IMPORT_OK_POSSIBLE_DUPLICATE_MSG;
		                        $jsonResp[] = $this->buildAtomicResponse(
                                    $occ->getId(), Response::HTTP_CREATED, null,
                                     $occAsArray, $msg . (string)$occCount );
			                }
                            else {
                                $msg = ImportOccurrenceAction::IMPORT_OK;
		                        $jsonResp[] = $this->buildAtomicResponse(
                                    $occ->getId(), Response::HTTP_CREATED, null, 
                                    $occAsArray, $msg . (string)$occCount );
                            }

	                    }// end if ( $errors = $this->validator->validate($occ) )
	                    else {
		                    $errors = $this->validator->validate($occ);
	                        $jsonResp[] = $this->buildAtomicResponse(
                                -1, Response::HTTP_UNPROCESSABLE_ENTITY, null, 
                                $occAsArray, $errors);
			                // @todo Check if nicely rendered
	                        throw new ValidationException(
                                $this->validator->validate($occ));
	                    }
            /*
	                    if ($occCount%25) {
	                        $em->flush();
	                    }
            */
		            } // end if ( null !== $occ)
		            else {
			            // First line: headers => we don't log anything:
			            if ( $occCount>1 ) {
                            $msg = ImportOccurrenceAction::IMPORT_OK_POSSIBLE_DUPLICATE_MSG;
				            $jsonResp[] = $this->buildAtomicResponse(
                                -1, Response::HTTP_UNPROCESSABLE_ENTITY, null, 
                                $occAsArray, $msg . (string)$occCount );
			            }
		            } // end else
                } // end foreach( $occArray as $occAsArray )
                $em->flush();
                $em->getConnection()->commit();

            } catch (\Throwable $e) {
                $em->getConnection()->rollBack();
                // Delete associated ES documents to avoid creating orphans 
                // and, thus, having  an out of sync ES index:
                $this->deleteDocumentsByIds($persistedOccIds);
                // swallow the Exception and inform the caller using the 
                // exception message:
                $jsonResp[] = $this->buildAtomicResponse(
                    -1, 500, null, $occAsArray, $e->getMessage());

                return new Response(
                    json_encode($jsonResp), Response::HTTP_INTERNAL_SERVER_ERROR, 
                    [$e->getMessage()]);
            }
        }
    	$jsonResp = new Response(
            json_encode($jsonResp), Response::HTTP_MULTI_STATUS, []);

        return $jsonResp;
    }

    private function buildAtomicResponse(
        $id, $status, $header, $body, $comment) {

         return array(
            $id => array(
                'status' => $status,
                'header' => $header,
                'comment' => $comment,
                'body' => $body
            )
        );
    }

    private static function deleteDocumentsByIds(array $ids) {
        ElasticsearchClient::deleteByIds($ids, 'occurrence');
    }

    protected function getUser() {

        if (!$this->tokenStorage) {
            $msg = ImportOccurrenceAction::UNREGISTERED_SECURITY_BUNDLE_MSG;
            throw new \LogicException($msg);
        }

        if (null === $token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

}


