<?php

namespace App\DBAL;
 
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed WidgetConfiguration entity location type values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class LocationTypeEnumType extends Type {

    const LOCATION_TYPE_ENUM = 'localisationtypeenum';
    const COORDINATES = 'coordonnées';
    const LOCALITY = 'localité';
    const GEO_ZONE = 'zone géo';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('coordonnées', 'localité', 'zone géo')";
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
        if (!in_array($value, array(null, self::COORDINATES, self::LOCALITY, self::GEO_ZONE))) {
            throw new \InvalidArgumentException("Invalid location type");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::LOCATION_TYPE_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
