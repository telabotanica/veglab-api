<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed location VL accuracy values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class VlLocationAccuracyEnumType extends Type {

    const VL_LOCATION_ACCURACY_TYPE_ENUM = 'vllocationaccuracytypeenum';
    const PRECISE = "Précise";
    const PLACE = "Lieu-dit";
    const CITY = "Commune";
    const DEPARTEMENT = "Département";
    const REGION = "Région";
    const COUNTRY = "Pays";
    const OTHER = "Autre/inconnu";

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('Précise', 'Lieu-dit', 'Commune', 'Département', 'Région', 'Pays', 'Autre/inconnu')";
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
        if (!in_array($value, array(null, self::PRECISE, self::PLACE, self::CITY, self::DEPARTEMENT, self::REGION, self::COUNTRY, self::OTHER))) {
            throw new \InvalidArgumentException("Invalid VL location accuracy type");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::VL_LOCATION_ACCURACY_TYPE_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
