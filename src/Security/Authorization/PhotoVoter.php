<?php

// src/Security/PhotoVoter.php
namespace App\Security\Authorization;

use App\Entity\Photo;
use App\Security\User\TelaBotanicaUser;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * <code>AbstractVoter</code> for <code>Photo</code> resources/entities.
 *
 * @package App\Security\Authorization
 */
class PhotoVoter extends OccurrenceVoter {

    /**
     * @inheritdoc
     */
    protected function voteOnAttribute(
        $attribute, $subject, TokenInterface $token) {

        $user = $token->getUser();
        $photo = $subject;

        if ($user->isTelaBotanicaAdmin()) {
            return true;
        }
        if ( $photo->getOccurrence() !== null ) {
            if ( $photo->getOccurrence()->getProject() !== null ) {
                $prjId = $photo->getOccurrence()->getProject()->getId();
                if ( $user->getAdministeredProjectId() == $prjId ) {
                    return $photo->getIsPublic();
                }
            }
        }        
        switch ($attribute) {
            case self::VIEW:
                return $this->canView($photo, $user);
            case self::EDIT:
                return $this->canEdit($photo, $user);
            case self::DELETE:
                return $this->canDelete($photo, $user);
        }

        throw new \LogicException('Unknown attribute: ' . $attribute);
    }


    /**
     * @inheritdoc
     */
    protected function supportsEntity($subject): bool {

        if (!$subject instanceof Photo) {
            return false;
        }

        return true;
    }

}
