<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed WidgetConfiguration taxo restriction type values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class TaxoRestrictionTypeEnumType extends Type {
    const TAXO_RESTRICTION_TYPE_ENUM = 'taxorestrictiontypeenum';
    const TAXON = 'taxon';
    const TAXA = 'taxa';
    const REPO = 'repository';

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
 
        return "ENUM('taxon', 'taxa', 'repository')";
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) {
 
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) {
 
        if (!in_array($value, array(null, self::TAXON, self::TAXA, self::REPO))) {
            throw new \InvalidArgumentException("Invalid taxo restriction type");
        }
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
 
        return self::TAXO_RESTRICTION_TYPE_ENUM;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
 
        return true;
    }

}
