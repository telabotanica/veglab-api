<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

use Doctrine\ORM\EntityManager;

class NoDuplicateConstraintValidator extends ConstraintValidator
{

    private $em;

    public function __construct(EntityManager $em) { 
        $this->em = $em;
    }

    public function validate($occ, Constraint $constraint)
    {
        if (!$constraint instanceof NoDuplicateConstraint) {
            throw new UnexpectedTypeException($constraint, NoDuplicateConstraint::class);
        }
       
        $hasDuplicate = $this->em->getRepository('Entity\Occurrence')->hasDuplicate($occ);

        if ( $hasDuplicate ) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

    }
}
