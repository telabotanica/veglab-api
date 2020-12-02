<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed location accuracy values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class LocationAccuracyEnumType extends Type {

    const LOCATION_ACCURACY_TYPE_ENUM = 'locationaccuracytypeenum';
    const LESS_THAN_TEN = '0 à 10 m';
    const TENS = '10 à 100 m';
    const HUNDREDS = '100 à 500 m';
    const SUBLOCALITY = 'Lieu-dit';
    const LOCALITY = 'Localité';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('0 à 10 m', '10 à 100 m', '100 à 500 m', 'Lieu-dit', 'Localité')";
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
        if (!in_array($value, array(null, self::LESS_THAN_TEN, self::TENS, self::HUNDREDS, self::SUBLOCALITY, self::LOCALITY))) {
            throw new \InvalidArgumentException("Invalid location accuracy type");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::LOCATION_ACCURACY_TYPE_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
