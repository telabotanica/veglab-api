<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed VL Date precision values. 
 *
 * @package App\DBAL
 */
class DatePrecisionEnumType extends Type {

    const DATE_PRECISION_ENUM = 'dateprecisionenum';
    const DAY = 'day';
    const MONTH = 'month';
    const YEAR = 'year';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return "ENUM('day', 'month', 'year')";
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
        if (!in_array($value, array(null, self::DAY, self::MONTH, self::YEAR))) {
            throw new \InvalidArgumentException("Invalid date precision value");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::DATE_PRECISION_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
