<?php

namespace App\Entity;

/**
 * Represents an entity belonging to a CEL user.
 *
 * @package App\Entity  
 *
 */
interface OwnedEntitySimpleInterface {

    public function getUserId(): ?int;   
    public function setUserId(?int $userId): OwnedEntitySimpleInterface;

}
