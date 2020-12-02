<?php

namespace App\TelaBotanica\Eflore\Api;

use App\Exception\UnsupportedEfloreTaxoRepoException;

/**
 * Client service for eflore Web service API. Currently, only offers methods 
 * to retrieve ancestor name for a given taxon.
 *
 * @package App\TelaBotanica\Eflore\Api
 */
class EfloreApiClient {

    // The base URL for eflore Web service API:
    const BASE_URL = 'https://api.tela-botanica.org/service:eflore:0.1/';
    const RESOURCE_NAME = 'taxons';
    // The allowed repository names (also called 'projets' but it can be 
    // misleading):
    const ALLOWED_REPO_NAMES = array(
        'bdtfxr', 'aublet', 'florical', 'bdtre', 'commun', 'sophy', 'apd', 
        'sptba', 'nvps', 'bdnt', 'bdtfx', 'bdtxa', 'chorodep', 'coste', 
        'eflore', 'fournier', 'insee-d', 'iso-3166-1', 'iso-639-1', 'nvjfl', 
        'cel', 'lion1906', 'liste-rouge', 'wikipedia', 'osm', 'prometheus', 
        'bibliobota', 'photoflora', 'baseflor', 'baseveg', 'sptb', 'isfan', 
        'nva', 'moissonnage', 'nasa-srtm', 'coord-transfo', 'lbf');
    // Constants for rank names as used in the Web services:
    const RANK_FAMILY = 'Famille';
    const RANK_ORDER  = 'Ordre';

    private function buildGetInfoTaxonUrl(
        int $taxonId, string $taxoRepo): string {

        $url = EfloreApiClient::BASE_URL;
        $url .= $taxoRepo;
        $url .= '/';
        $url .= EfloreApiClient::RESOURCE_NAME;
        $url .= '/';
        $url .= $taxonId;

        return $url;
    }

    /**
     * Returns an array containing the upper taxa hierarchy in the $taxoRepo
     * repository for the taxon with ID = $taxonId.
     *
     * @param int $taxonId The ID of the taxon to retrieve the ancestor names
     *        for.
     * @param string $taxoRepo The name of the taxonomic repository to retrieve
     *        the taxon ancestor names from.
     *
     * @return EfloreTaxon The description for the taxon with ID = $taxonId
     *         in the $taxoRepo repository.
     *
     * @throws UnsupportedEfloreTaxoRepoException
     */
    public function getTaxonInfo(int $taxonId, string $taxoRepo): EfloreTaxon {
        if ( in_array($taxoRepo, EfloreApiClient::ALLOWED_REPO_NAMES) ) {

            $url = $this->buildGetInfoTaxonUrl($taxonId, $taxoRepo);

            $curl_request = curl_init($url);

            curl_setopt($curl_request, CURLOPT_HEADER, 0);
            curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_request, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl_request, CURLOPT_CONNECTTIMEOUT, 5);
            $result = curl_exec($curl_request); // execute the request

            curl_close($curl_request);

            $rawTaxon = json_decode($result, true);

            $taxon = new EfloreTaxon();
            $taxon->setAcceptedSciName($rawTaxon['nom_complet']);
            $taxon->setAcceptedSciNameId($rawTaxon['nom_retenu.id']);
            $taxon->setFamily($rawTaxon['famille']);

            return $taxon;
        } else {
            throw new UnsupportedEfloreTaxoRepoException('Unknown taxo repo ' . $taxoRepo);
        }
    }
}



