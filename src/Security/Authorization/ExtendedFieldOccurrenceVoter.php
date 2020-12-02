<?php

namespace App\Security\Authorization;

use App\Entity\ExtendedFieldOccurrence;
use App\Security\User\TelaBotanicaUser;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * <code>AbstractVoter</code> for <code>ExtendedFieldOccurrence</code> 
 * resources/entities.
 *
 * @package App\Security\Authorization
 */
class ExtendedFieldOccurrenceVoter extends AbstractVoter {

    /**
     * @inheritdoc
     */
    protected function supportsEntity($subject): bool {

        if (!$subject instanceof ExtendedFieldOccurrence) {
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

        // Only the owner of the associated occurrence can view/update/delete 
        // this resource:        
        return ( $user->getId() === $inst->getOccurrence()->getUserId() );
    }


}
