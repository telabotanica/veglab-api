<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * ENUM type for allowed phenology values. 
 *
 * @package App\DBAL
 * @refactor: DRY all DBAL types using a superclass, children will only have 
 *            a constant associative array, a type_enum and an error msg.
 */
class PhenologyEnumType extends Type {

    const PHENOLOGY_ENUM = 'phenologyenum';
    const ZERO_NINE = '00-09: germination, développement des bourgeons';
    const TEN_NINETEEN = '10-19: développement des feuilles';
    const ELEVEN = '11: environ 10% des feuilles épanouies';
    const FIFTEEN = '15: environ 50% des feuilles épanouies';
    const TWENTY_TWENTYNINE = '20-29: formation de pousses latérales, tallage';
    const THIRTY_THIRTY_NINE = '30-39: développement des tiges, croissance des rosettes';
    const FORTY_FORTYNINE = '40-49: développement des organes de propagation végétative';
    const FIFTY_FIFTYNINE = '50-59: apparition de l\'inflorescence, épiaison';
    const SIXTY_SIXTYNINE = '60-69: floraison';
    const SIXTYONE = '61: environ 10% des fleurs épanouies';
    const SIXTYFIVE = '65: environ 50% des fleurs épanouies';
    const SEVENTY_SEVENTYNINE = '70-79: fructification';
    const HEIGHTY_HEIGHTYNINE = '80-89: maturité des fruits et des graines';
    const HEIGHTYFIVE = '85: environ 50% des fruits matures';
    const NINETY_NINETYNINE = '90-99: sénescence et dormance';
    const NINETYONE = '91: environ 10% des feuilles sont tombées ou ont changé de couleur';
    const NINETYFIVE = '95: environ 50% des feuilles sont tombées ou ont changé de couleur';

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
 
        return "ENUM('00-09: germination, développement des bourgeons', " .
               "'10-19: développement des feuilles', " .
               "'11: par ex, environ 10% des feuilles épanouies', " .
               "'15: par ex, environ 50% des feuilles épanouies', " .
               "'20-29: formation de pousses latérales, tallage', " .
               "'30-39: développement des tiges, croissance des rosettes', " .
               "'40-49: développement des organes de propagation végétative', " .
               "'50-59: apparition de l\'inflorescence, épiaison', " .
               "'60-69: floraison', " .
               "'61: par ex, environ 10% des fleurs épanouies', " .
               "'65: par ex, environ 50% des fleurs épanouies', " .
               "'70-79: fructification', " .
               "'80-89: maturité des fruits et des graines', " .
               "'85: par ex, 50% des fruits matures', " .
               "'90-99: sénescence et dormance', " .
               "'91: environ 10% des feuilles sont tombées ou ont changé de couleur', " .
               "'95: environ 50% des feuilles sont tombées ou ont changé de couleur')";
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
 
        if (!in_array($value, array(null, self::ZERO_NINE, self::TEN_NINETEEN, self::ELEVEN, self::FIFTEEN, self::TWENTY_TWENTYNINE , self::THIRTY_THIRTY_NINE, self::FORTY_FORTYNINE, self::FIFTY_FIFTYNINE, self::SIXTY_SIXTYNINE, self::SIXTYONE, self::SIXTYFIVE, self::SEVENTY_SEVENTYNINE, self::HEIGHTY_HEIGHTYNINE, self::HEIGHTYFIVE, self::NINETY_NINETYNINE, self::NINETYONE, self::NINETYFIVE, ))) {
            throw new \InvalidArgumentException("Invalid phenology value");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
 
        return self::PHENOLOGY_ENUM;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
 
        return true;
    }

}
