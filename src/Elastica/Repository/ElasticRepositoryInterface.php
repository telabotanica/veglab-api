<?php

namespace App\Elastica\Repository;

use FOS\ElasticaBundle\Repository;
use App\Entity\Photo;

/**
 * Finds and counts resource instances matching the HTTP request parameters
 * and accessible by current user.
 *
 * @package App\Elastica\Repository
 */
// @refactor: use generics if it's possible to pass them in conf files
// @refactor: type parameters
interface ElasticRepositoryInterface {

    /**
     * Returns an array of resource instances matching 
     *         provided HTTP request parameters.
     *
     * @param Request $request The HTTP request containing the 
     *        search/sort/pagination parameters.
     * @param TelaBotanicaUser $user The current user.
     * 
     * @return array Returns an array of resource instances
     *         matching provided HTTP request parameters.
     */
    public function findWithRequest($request, $user);

    /**
     * Returns the total number of resource instances matching 
     *         provided HTTP request parameters.
     *
     * @param Request $request The HTTP request containing the 
     *        search/sort/pagination parameters.
     * @param TelaBotanicaUser $user The current user.
     * 
     * @return the total number of resource instances matching 
     *         provided HTTP request parameters.
     */
    public function countWithRequest($request, $user);  

}
