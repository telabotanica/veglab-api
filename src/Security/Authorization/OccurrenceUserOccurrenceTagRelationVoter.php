<?php

namespace App\Security\Authorization;

use App\Entity\OccurrenceUserOccurrenceTagRelation;
use App\Security\User\TelaBotanicaUser;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * <code>AbstractVoter</code> for 
 * <code>OccurrenceUserOccurrenceTagRelation</code> resources/entities.
 *
 * @package App\Security\Authorization
 */
class OccurrenceUserOccurrenceTagRelationVoter extends AbstractVoter
{

    /**
     * @inheritdoc
     */
    protected function supportsEntity($subject): bool {

        if (!$subject instanceof OccurrenceUserOccurrenceTagRelation) {
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
        $inst = $subject;

        // Only the owner can view/update/delete this resource:        
        return ( 
            ( $user->getId() === $inst->getOccurrence()->getUserId() ) && 
            ( $user->getId() === $inst->getUserOccurrenceTag()->getUserId() ) );
    }


}
