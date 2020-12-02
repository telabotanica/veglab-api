<?php

namespace App\Controller;

use App\Form\OccurrenceType;
use App\Utils\FromArrayOccurrenceCreator;
use App\Repository\PhotoRepository;

use ZipArchive;
 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Vich\UploaderBundle\Storage\StorageInterface;

// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Returns a zip archive containing the photos which ids have been passed as
 * parameters. 
 *
 * @package App\Controller
 */
final class ServeZippedPhotosAction {

    private $doctrine;
    private $storage;
    private $tokenStorage;
    private $tmpFolder;

    const ENTITY_FILE_PROPERTY_NAME = 'file';
    const ZIP_FILE_PREFIX = 'PhotosCel_';
    const ZIP_EXTENSION = ".zip";

    /**
     * Returns a new <code>ServeZippedPhotosAction</code> instance 
     * initialized with (injected) services passed as parameters.
     *
     * @param TokenStorageInterface $tokenStorage The injected 
     *        <code>TokenStorageInterface</code> service.
     * @param StorageInterface $storage The injected 
     *        <code>StorageInterface</code> service.
     * @param ManagerRegistry $doctrine The injected 
     *        <code>ManagerRegistry</code> service.
     * 
     * @return ServeZippedPhotosAction Returns a new  
     *         <code>ServeZippedPhotosAction</code> instance initialized 
     *         with (injected) services passed as parameters.
     */
    public function __construct(
        StorageInterface $storage, 
        ManagerRegistry $doctrine,
        TokenStorageInterface $tokenStorage) {

    	$this->tokenStorage = $tokenStorage;
        $this->doctrine = $doctrine;
        $this->storage = $storage;
        $this->tmpFolder = getenv('TMP_FOLDER');
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
    public function __invoke(Request $request): Response {

        $zip = new \ZipArchive;
        $zipName = ServeZippedPhotosAction::ZIP_FILE_PREFIX . time();
        $zipName .= ServeZippedPhotosAction::ZIP_EXTENSION;
        $zipFilePath = $this->tmpFolder . '/' . $zipName;

        // @todo trycatch 500
        if ($zip->open(
            $zipFilePath,  
            \ZipArchive::CREATE)) {

            $em = $this->doctrine->getManager();
		    $photoRepo = $em->getRepository('App\Entity\Photo');
            // @todo Do a DQL 'in' query instead:
            $ids = $request->query->get('id');
            $photos = $photoRepo->findById($ids);
            // First populate the archive file:                 
            $this->populateZip($zip, $photoRepo, $ids); 
            $zip->close();

            // Then, send the generated file:
            return $this->buildResponse($zipFilePath, $zipName);
        }
        else {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            return $response;
        }
    }


    private function populateZip(ZipArchive $zip, PhotoRepository $repo, array $ids) {
        foreach ($ids as $id) {
            $photos = $repo->findById($id);
            if (sizeof($photos)>0) {
                $photo = $photos[0];
                $zip->addFile($photo->getContentUrl(), basename($photo->getContentUrl()));
            }
        }
    }

    private function buildResponse(string $zipFilePath, string $zipName): Response {
        $response = new Response(file_get_contents($zipFilePath));
        $response->headers->set('Content-Type', 'application/zip');
        $response->headers->set(
            'Content-Disposition', 
            'attachment;filename="' . $zipName . '"');
        $response->headers->set(
            'Content-length', 
            filesize($zipFilePath));

        return $response;
    }

}


