<?php

namespace App\Controller;

use App\Entity\PhotoTag;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Dotenv\Dotenv;

/** 
 * Simple proxy to pl@]ntNet API.
 */
class PlantnetProxyController extends AbstractController {
 
    const PN_RESPONSE_PREFIX = 'PlantNetResponse';
    const PN_RESPONSE_EXTENSION = ".json";

    private $tmpFolder;

    public function __construct() {
        $this->tmpFolder = getenv('TMP_FOLDER');
    }

    /**
     *
     * @Route("/api/plantnet", name="api_plantnet")
     */
    public function invoke(Request $request) {        

        $url = $this->buildUrl($request);

        $pnRespFileName = PlantnetProxyController::PN_RESPONSE_PREFIX . time();
        $pnRespFileName .= PlantnetProxyController::PN_RESPONSE_EXTENSION;
        $pnRespFilePath = $this->tmpFolder . '/' . $pnRespFileName;

        try {

            file_put_contents($pnRespFilePath, fopen($url, 'r'));
            // Now send the generated file:
            $response = new Response(file_get_contents($pnRespFilePath));
            return $response;

        } catch (\Exception $t) {

            // Translate the error message raised by the proxied service: 
            $jsonResp = array('errorMessage' => $t->getMessage());
            // Return a  500 with an informative msg as JSON:
            return new Response(json_encode($jsonResp), Response::HTTP_INTERNAL_SERVER_ERROR, []);
        }   

        exit;
    }


    private function buildUrl($request) {
        return getenv('PLANTNET_API_URL') . '?' . urldecode($request->getQueryString()) . '&api-key=' . getenv('PLANTNET_API_KEY'); 
    }

}
