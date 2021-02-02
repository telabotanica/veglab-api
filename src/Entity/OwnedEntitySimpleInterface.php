<?php

namespace App\Entity;

/**
 * Represents an entity belonging to a CEL user.
 *
 * @package App\Entity  
 *
 */
interface OwnedEntitySimpleInterface {

    public function getUserId(): ?string;   
    public function setUserId(?string $userId): OwnedEntitySimpleInterface;

}
