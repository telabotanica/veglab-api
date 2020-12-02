<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for occurrences type values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class OccurrenceTypeEnumType extends Type
{
    const OCCURRENCE_TYPE_ENUM = 'occurrencetypeenum';
    const FIELD = 'observation de terrain';
    const LITTERATURE = 'issue de la bibliographie';
    const HERBARIUM = 'donnée d\'herbier';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
 
        return "ENUM('observation de terrain', 'issue de la bibliographie', 'donnée d\'herbier')";
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
 
        if (!in_array($value, array(null, self::FIELD, self::LITTERATURE, self::HERBARIUM))) {
            throw new \InvalidArgumentException("Invalid occurrence type");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
 
        return self::OCCURRENCE_TYPE_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
 
        return true;
    }

}
