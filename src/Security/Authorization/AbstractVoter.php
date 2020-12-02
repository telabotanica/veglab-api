<?php

namespace App\Security\Authorization;

use App\Entity\OwnedEntitySimpleInterface;
use App\Security\User\TelaBotanicaUser;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use App\DBAL\InputSourceEnumType;

/**
 * Abstract security voter for entities/resources which need access control
 * (ACL) based on current user.
 *
 * This class provides basic behavior : only the owner or a TelaBotanica 
 * admin can create/read/update/delete the entity/resource instances.
 *
 * @package App\Security\Authorization
 */
abstract class AbstractVoter extends Voter {

    const VIEW      = 'view';
    const EDIT      = 'edit';
    const DELETE    = 'delete';

    protected function supports($attribute, $subject) {
        return ( $this->supportsEntity($subject) && 
            $this->supportsAttribute($attribute) );
    }

    abstract protected function supportsEntity($subject): bool;

    protected function supportsAttribute($attribute): bool {
        $supportedAtts = array(self::VIEW, self::EDIT, self::DELETE);
        // if the attribute isn't one we support, return false
        if ( !in_array($attribute, $supportedAtts) ) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(
        $attribute, $subject, TokenInterface $token) {

        $user = $token->getUser();
        $entitity = $subject;

        if ($user->isTelaBotanicaAdmin()) {
            return true;
        }

        $subjectClass = get_class($subject);
        if($subjectClass === 'App\Entity\Occurrence') {
            // Occurrence from VegLab ? --> Allow read 
            if ($subject->getInputSource() === InputSourceEnumType::VEGLAB && $attribute !== self::DELETE) {
                return true;
            }
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($entitity, $user);
            case self::EDIT:
                return $this->canEdit($entitity, $user);
            case self::DELETE:
                return $this->canDelete($entitity, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    protected function canView(
        OwnedEntitySimpleInterface $entitity, TelaBotanicaUser $user): bool {
        return ( $user->getId() === $entitity->getUserId() );
    }

    protected function canEdit(
        OwnedEntitySimpleInterface $entitity, TelaBotanicaUser $user): bool {
        return ( $user->getId() === $entitity->getUserId() );
    }

    protected function canDelete(
        OwnedEntitySimpleInterface $entitity, TelaBotanicaUser $user): bool {
        return ( $user->getId() === $entitity->getUserId() );
    }

}
