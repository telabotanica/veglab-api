<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoDuplicateConstraint extends Constraint
{
    public $message = 'Duplicated occurrences are not allowed (same locality/coordinates, same species, same day of observation).';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}
