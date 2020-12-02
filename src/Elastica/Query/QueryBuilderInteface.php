<?php

namespace App\Elastica\Query;

use App\Security\User\TelaBotanicaUser;

use Elastica\Query;

/**
 * Builds elastica <code>Query</code>s from CEL <code>Query</code>s and 
 * currently logged in user's access rights.
 */
interface QueryBuilderInteface {

    /**
     * Returns an elastica <code>Query</code> from a CEL <code>Query</code>
     * and currently logged in user's access rights.
     *
     * @param $user: the currently logged in <code>TelaBotanicaUser</code>.
     * @param $query: the CEL <code>Query</code> to build the elastica 
     *        <code>Query</code> from.
     * @return an elastica query from a CEL <code>Query</code> and currently 
     *         logged in user's access rights.
     */
    public function build(TelaBotanicaUser $user, QueryInterface $query): Query;

}



