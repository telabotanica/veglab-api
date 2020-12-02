<?php

namespace App\Service;

use App\Entity\PhotoTag;
use App\Excpetion\ExportServiceInvokationException;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/** 
 * Simple service for invoking the export widget API.
 */
// @refactor: use curl
class ExportOccurrenceService {

    const EXPORT_PREFIX = 'ExportCel_';
    const EXPORT_EXTENSION = '.csv';
    const EXCEPTION_MESSAGE_PREFIX = 'An error occurred while invoking ' . 
        'export Web services. Error cause:';
    const MANDATORY_URL_PARAMS = '&format=csv&colonnes=avance,etendu';

    // the <code>TokenStorageInterface</code> service to retrieve the current 
    // user:
    protected $tokenStorage;
    protected $entityManager;

    private $tmpFolder;

    // Mapping between CEL2 filter params and the occurrence export Web service
    // ones - only params that justs needs to be directly translated to the 
    // target params. Those that need processing (project, tags)
    private const PARAM_MAPPING = array(
        'freeTextQuery'   => 'recherche',
        'frenchDep' => 'departement',
        "isIdentiplanteValidated" => 'validation_identiplante',
        'locality' => 'commune',
        'osmCountry' => 'pays',
        "dateObservedDay" => 'jour',
        "dateObservedMonth" => 'mois',
        "dateObservedYear" => 'annee',
        'certainty'      => 'certitude',
        'isPublic' => 'transmission',
    );


    private const PARAM_VALUE_MAPPING = array(
        'true'   => 1,
        'false' => 0
    );

    private $paramsAsString;

    /**
     * Returns a new <code>BaseCollectionDataProvider</code> instance 
     * initialized with (injected) services passed as parameters.
     *
     * @param Security $security The injected <code>Security</code> service.<     * @param RepositoryManagerInterface $repositoryManager The injected 
     *        <code>RepositoryManagerInterface</code> service.
     * @param RequestStack $requestStack The injected <code>RequestStack</code>
     *        service.
     *
     * @return BaseCollectionDataProvider Returns a new  
     *         <code>BaseCollectionDataProvider</code> instance initialized 
     *         with (injected) services passed as parameters.
     */
    public function __construct(
        TokenStorageInterface $tokenStorage, 
        EntityManagerInterface $entityManager) {

        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
        $this->tmpFolder = getenv('TMP_FOLDER');
    }


    public function getExportResponse(array $params): Response {        
        // This can be a looooong operation, let's disable the timeout
        // momentarily:
        set_time_limit(0);
        $url = $this->buildUrl($params);

        $token = $this->tokenStorage->getToken();
        $user =  $token->getUser();

        try {
            $curl_request = curl_init($url);
            curl_setopt($curl_request, CURLOPT_HTTPHEADER, [
		    'Authorization: ' . $user->getToken()
	    ]);
            curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
            // execute the request
            $result = curl_exec($curl_request);
            curl_close($curl_request);

            // Now send the generated file:
            $response = new Response($result);
            $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');

            return $response;
        } catch (\Exception $t) {
            throw new ExportServiceInvokationException(
                ExportOccurrenceService::EXCEPTION_MESSAGE_PREFIX .
                $t->getMessage(),
                0,
                $t);
        }  finally {
            // Restore the timeout to its default, 30 secs, value:
            set_time_limit(30);
        }
 
    }

    private function buildParamString($params) {
        $this->paramsAsString = '';
        $paramNames = array_keys($params);
        foreach($paramNames as $paramName) {
            
            if ( array_key_exists($paramName, ExportOccurrenceService::PARAM_MAPPING) ) {  
                $wsParamName = ExportOccurrenceService::PARAM_MAPPING[$paramName];                
                $this->addParamToTargetUrl($wsParamName, $params[$paramName]);
            }
            if ( $paramName == "projectId" ) {
                $this->processProject($params['projectId']);
            }
            if ( $paramName == "ids" ) {
                $this->processIds($params['ids']);
            }
            if ( $paramName == "tags" ) {
                $this->processTags($params['tags']);
            }
        }
        $this->paramsAsString = substr($this->paramsAsString, 1);

        return $this->paramsAsString; 
    }

    private function processTags($tags) {
        $wsTags = "";
        foreach($tags as $tag) {
            $wsTags = $wsTags . $tag . "ET"; 
        }
        $wsTags =  substr(trim($wsTags), 0, -2);
        $this->addParamToTargetUrl("mots-cles", $wsTags);
    }

   private function processProject($projectId) {
        $prj = $this->entityManager->getRepository('App:TelaBotanicaProject')->find($projectId);
        $this->addParamToTargetUrl("programme", $prj->getLabel());
    }

   private function processIds($ids) {
        $wsIds = '';
        foreach($ids as $id) {
            $wsIds = $wsIds . $id . ","; 
        }
        $wsIds =  substr(trim($wsIds), 0, -1);
        $this->addParamToTargetUrl("obsids", $wsIds);
    }

   private function addAccessControlParameter() {
        $token = $this->tokenStorage->getToken();
        $user =  $token->getUser();

        if (!$user->isTelaBotanicaAdmin()) {
            // Project admins: limit to occurrences belonging to the project
            if ($user->isProjectAdmin()) {
                $this->addParamToTargetUrl(
                    "prj", $user->getAdministeredProjectId());
            }
            // Simple users: limit to her/his occurrences
            else if (!is_null($user)){
                $this->addParamToTargetUrl("id_utilisateur", $user->getId());
            }
            // Not even logged in user: limit to only public occurrences
            else {
                $this->addParamToTargetUrl("transmission", 1);
            }
        }
        // else, Tela-botanica admin: no restrictions!

    }

    private function addParamToTargetUrl($name, $value) {
        $this->paramsAsString = $this->paramsAsString . '&' . $name . '=' . 
            $this->translateParamValue($value);
    }

    private function translateParamValue($value) {
        if ( array_key_exists(
            $value, ExportOccurrenceService::PARAM_VALUE_MAPPING) ) {   
            return ExportOccurrenceService::PARAM_VALUE_MAPPING[$value];
        }
        else {
            return $value;
        }
    }

    private function buildUrl(array $params) {
        $this->buildParamString($params);
        $this->addAccessControlParameter();
        $this->paramsAsString = $this->paramsAsString . ExportOccurrenceService::MANDATORY_URL_PARAMS;

        return getenv('EXPORT_SERVICE_URL') . '?' . $this->paramsAsString; 
    }

}
