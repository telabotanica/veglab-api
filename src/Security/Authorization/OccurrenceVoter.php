<?php

namespace App\Security\Authorization;

use App\Entity\Occurrence;
use App\Entity\OwnedEntitySimpleInterface;
use App\Security\User\TelaBotanicaUser;
use App\DBAL\InputSourceEnumType;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * <code>AbstractVoter</code> for <code>Occurrence</code> resources/entities.
 *
 * @package App\Security\Authorization
 */
class OccurrenceVoter extends AbstractVoter {

    /**
     * @inheritdoc
     */
    protected function supportsEntity($subject): bool {

        if (!$subject instanceof Occurrence) {
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
        $occ = $subject;

        if ($user->isTelaBotanicaAdmin()) {
            return true;
        }
        if ($occ->getInputSource() === InputSourceEnumType::VEGLAB && $occ->getIsPublic() === true) {
            return true;
        }
	    if (null !== $occ->getProject()) {
            $prjId = $occ->getProject()->getId();
		    if ($user->getAdministeredProjectId() == $occ->getProject()->getId()) {
		        return $occ->getIsPublic();
		    }

	    }

        return parent::voteOnAttribute($attribute, $subject, $token);
    }

    /**
     * @inheritdoc
     */
    protected function canView(
        OwnedEntitySimpleInterface $occ, TelaBotanicaUser $user): bool {

        // if they can edit, they can view
        if ($this->canEdit($occ, $user)) {
            return true;
        }

        return $occ->getIsPublic();
    }

}
