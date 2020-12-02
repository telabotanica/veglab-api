<?php

namespace App\Utils;

use Elastica\Query;

use Symfony\Component\Dotenv\Dotenv;

/**
 * Elasticsearch HTTP API client. Only used to retrieve the total number 
 * of hits for given <code>Query</code> and index name of the resource in 
 * ES. Introduced because of an elastica bug (failing at counting 
 * total number of hits).
 *
 * @internal the conf is in the .env file while it should be retrieved from 
 *           foselastica yaml config. Unfortunately, no *clean* way has been 
 *           found to access foselastica conf...
 * @package App\Utils
 */
/*
Elastica bug:
//
// getNbResults() returns 1... howmanyever the number of actual hits...
// elastica is buggy on this... 
$results = $this->findPaginated($esQuery);
$results->setMaxPerPage(10);
$results->setCurrentPage(1);
return $results->getNbResults();

// This workaround has also been tried but the searchable also returns 1...     
// https://stackoverflow.com/questions/27146787/count-query-with-php-elastica-and-symfony2-foselasticabundle/31162189
*/
//@refactor if not int throw ElasticsearchCountException
//@refactor: use public static const var for 'occurrence' and 'photo' + use them in ImportOccurrenceAction + syncdoc command
class ElasticsearchClient {
    
    /**
     * Returns the total number of hits for given <code>Query</code> and type
     * name of the resource/entity in ES.
     */
    public static function count(
        Query $esQuery, string $resourceTypeName): int {
        $queryAsArray = $esQuery->getQuery()->toArray();
        $strQuery = json_encode(["query" => $queryAsArray]);
        $ch = curl_init(ElasticsearchClient::buildCountUrl($resourceTypeName));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strQuery);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($strQuery))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        //execute post
        $result = curl_exec($ch);
        $resp = json_decode($result);
        //close connection
        curl_close($ch);

        return intVal($resp->count);
    }


    /**
     * Returns the total number of hits for given <code>Query</code> and type
     * name of the resource/entity in ES.
     */
    public static function deleteById(
        int $id, string $resourceTypeName): string {

        $ch = curl_init(ElasticsearchClient::buildDeleteByIdUrl($resourceTypeName, $id));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        //execute delete using ES API
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);

        return $result;
    }


    /**
     * Returns the total number of hits for given <code>Query</code> and type
     * name of the resource/entity in ES.
     */
    public static function deleteByIds(
        array $ids, string $resourceTypeName): array {

        $responses = array();
        foreach ($ids as $id){
            $responses[] = ElasticsearchClient::deleteById($id, $resourceTypeName);
        }

        return $responses;
    }

    private static function buildCountUrl(string $resourceTypeName): string {
        $url = ElasticsearchClient::buildBaseUrl($resourceTypeName);
        $url .= '/_count';

        return $url;
    }
 

    private static function buildDeleteByIdUrl(string $resourceTypeName, int $id): string {
        $url = ElasticsearchClient::buildBaseUrl($resourceTypeName);
        $url .= '/';
        $url .= $id;

        return $url;
    }

    private static function buildBaseUrl(string $resourceTypeName): string {
        $url = null;
        // @refactor use class constants here (and in OccRepo + PhotoRepo as well
        if ($resourceTypeName == 'occurrence')  {
            $url = getenv('ELASTICSEARCH_OCC_INDEX_URL');
        }
        if ($resourceTypeName == 'photo')  {
            $url = getenv('ELASTICSEARCH_PHOTO_INDEX_URL');
        }      
        // @refactor Else we should raise a custom exception  
        $url .= $resourceTypeName;

        return $url;
    }

}


