<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed WidgetConfiguration entity localisation type values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class LanguageEnumType extends Type {

    const ENV_TYPE_ENUM = 'languageenum';
    const INVALID_ARGUMENT_MESSAGE = 'Invalid language';
    const EN = 'EN';
    const FR = 'FR';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('EN', 'FR')";
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
        if (!in_array($value, array(null, self::EN, self::FR))) {
            throw new \InvalidArgumentException(self::INVALID_ARGUMENT_MESSAGE);
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::ENV_TYPE_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
