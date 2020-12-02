<?php

namespace App\Security\Authorization;

use App\Entity\UserProfileCel;
use App\Security\User\TelaBotanicaUser;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Security <code>AbstractVoter</code> for:
 *
 * <ul>
 *   <li><code>UserProfileCel</code></li> 
 *   <li><code>UserCustomField</code></li>
 *   <li><code>PhotoTag</code></li>
 *   <li><code>UserOccurrenceTag</code></li>
 *   <li><code>UserCustomFieldOccurrence</code></li>
 * </ul>
 *
 * resources/entities. 
 *
 * Only the owner or a TelaBotanica admin can create/read/update/delete 
 * instances.
 *
 * @package App\Security\Authorization
 */
class BaseVoter extends AbstractVoter {

    /**
     * @inheritdoc
     */
    protected function supportsEntity($subject): bool {

        if ( !( $subject instanceof UserProfileCel ) ||  
            !( $subject instanceof UserCustomField ) || 
            !( $subject instanceof PhotoTag ) || 
            !( $subject instanceof UserOccurrenceTag ) ||
            !( $subject instanceof UserCustomFieldOccurrence ) ) {

            return false;
        }

        return true;
    }

}
