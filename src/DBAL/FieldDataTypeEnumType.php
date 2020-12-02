<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed ExtendedField and UserCustomField dataType property 
 * values. 
 *
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 * @package App\DBAL
 */
class FieldDataTypeEnumType extends Type {

    const FIELD_DATA_TYPE_ENUM = 'fielddatatypeenum';
    const BOOL = 'Booléen';
    const TEXT = 'Texte';
    const DATE = 'Date';
    const INTEGER = 'Entier';
    const DECIMAL= 'Décimal';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('Booléen', 'Texte', 'Date', 'Entier', 'Décimal')";
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
        if (!in_array($value, array(self::DATE, self::BOOL, self::TEXT, self::INTEGER, self::DECIMAL))) {
            throw new \InvalidArgumentException("Invalid data type");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::FIELD_DATA_TYPE_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
