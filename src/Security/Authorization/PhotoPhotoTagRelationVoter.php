<?php

// src/Security/CelUserProfileVoter.php
namespace App\Security\Authorization;

use App\Entity\PhotoPhotoTagRelation;
use App\Security\User\TelaBotanicaUser;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * <code>AbstractVoter</code> for <code>PhotoPhotoTagRelation</code> 
 * resources/entities.
 *
 * @package App\Security\Authorization
 */
class PhotoPhotoTagRelationVoter extends AbstractVoter {

    /**
     * @inheritdoc
     */
    protected function supportsEntity($subject): bool {

        if (!$subject instanceof PhotoPhotoTagRelation) {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    protected function voteOnAttribute(
        $attribute, $subject, TokenInterface $token) {

        $user = $token->getUser();

        // Only the owner can view/update/delete this resource:        
        return ( 
            ( $user->getId() === $subject->getPhoto()->getUserId() ) && 
            ( $user->getId() === $subject->getPhotoTag()->getUserId() ) );
    }


}
