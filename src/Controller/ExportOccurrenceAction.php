<?php

namespace App\Controller;

use App\Service\ExportOccurrenceService;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/** 
 * Simple proxy action to the export widget API.
 */
class ExportOccurrenceAction {

    // the <code>ExportOccurrenceService</code> service in charge of invoking
    // the export widget API:
    /**
     * @var ExportOccurrenceService
     */
    private $exportService;

    /**
     * @param ExportOccurrenceService $exportService the 
     *        <code>ExportOccurrenceService</code> service in charge of 
     *        invoking the export widget API:
     */
    public function __construct(ExportOccurrenceService $exportService) {
        $this->exportService = $exportService;
    }

    public function __invoke(Request $request) {       
        $params = $request->query->all(); 
        try {
            return $this->exportService->getExportResponse($params);
        } catch (\Exception $t) {
            $jsonResp = array('errorMessage' => $t->getMessage());

            // Return a  500 with an informative msg as JSON:
            return new Response(
                json_encode($jsonResp), 
                Response::HTTP_INTERNAL_SERVER_ERROR, []);
        }   

    }



}
