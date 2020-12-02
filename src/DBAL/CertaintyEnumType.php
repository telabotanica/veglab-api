<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed Taxo identification certainty values. 
 *
 * @package App\DBAL
 *
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class CertaintyEnumType extends Type {

    const CERTAINTY_ENUM = 'certaintyenum';
    const TO_BE_DETERMINED = 'à déterminer';
    const DOUBTFUL = 'douteux';
    const CERTAIN = 'certain';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('à déterminer', 'douteux', 'certain')";
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) {
        if (!in_array($value, array(null, self::DOUBTFUL, self::CERTAIN, self::TO_BE_DETERMINED))) {
            throw new \InvalidArgumentException("Invalid certainty value");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::CERTAINTY_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
