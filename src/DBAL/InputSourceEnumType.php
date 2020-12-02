<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed input source values. 
 *
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 * @package App\DBAL
 */
class InputSourceEnumType extends Type {

    const INPUT_SOURCE_ENUM = 'inputsourceenum';
    const CEL = 'CEL';
    const WIDGET = 'widget';
    const VEGLAB = 'VegLab';
    const PLANTNET = 'PlantNet';
    const OTHER = 'autre';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('CEL', 'widget', 'VegLab', 'PlantNet', 'autre')";
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
        if (!in_array($value, array(self::CEL, self::VEGLAB, self::PLANTNET, self::OTHER, self::WIDGET))) {
            throw new \InvalidArgumentException("Invalid input source");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::INPUT_SOURCE_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
