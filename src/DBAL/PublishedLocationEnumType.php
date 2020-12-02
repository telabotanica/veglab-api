<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed published location accuracy values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class PublishedLocationEnumType extends Type {

    const PUBLISHED_LOCATION_ENUM = 'publishedlocationenum';
    const PRECISE = 'précise';
    const LOCALITY = 'localité';
    const TEN_BY_TEN = '10x10km';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
 
        return "ENUM('précise', 'localité', '10x10km')";
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
 
        if (!in_array($value, array(null, self::PRECISE, self::LOCALITY, self::TEN_BY_TEN))) {
            throw new \InvalidArgumentException("Invalid published loocation value");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
 
        return self::PUBLISHED_LOCATION_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
 
        return true;
    }

}
