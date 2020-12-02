<?php

namespace App\Entity;

/**
 * Represents an entity belonging to a CEL user which holds her/his email and
 * pseudo as attributes.
 *
 * @package App\Entity  
 *
 */
interface OwnedEntityFullInterface extends OwnedEntitySimpleInterface {

    public function getUserEmail(): ?string;
    public function setUserEmail(?string $userEmail): OwnedEntityFullInterface;
    public function getUserPseudo(): ?string;
    public function setUserPseudo(?string $userPseudo): OwnedEntityFullInterface;

}
