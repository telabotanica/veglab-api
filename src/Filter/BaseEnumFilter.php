<?php

namespace App\Filter;

/** 
 * Description of an API platform filter (textual decription, is required ?, 
 * type, property name). 
 *
 * @package App\Filter
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class BaseEnumFilter extends BaseFilter {

    private $enum;

    /**
     * @inheritdoc
     */
    function __construct(
        string $propertyName, string $type, 
        string $textDescription, string $isRequired,
        array $enum) {

        parent::__construct(
            $propertyName, $type, $textDescription, $isRequired);
        $this->enum = $enum;

    }

    /**
     * @inheritdoc
     */
    public function getEnum() : array {
        return $this->enum;
    }

    /**
     * @inheritdoc
     */
    public function getDescription(string $resourceClass) : array
    {
        $description = [];
        $description[$this->getPropertyName()] = [
            'property' => $this->getPropertyName(),
            'required' => $this->isRequired(),
            'type' => $this->getType(),
            'swagger' => [
                'description' => $this->getTextDescription(),
                'name' => $this->getPropertyName(),
                'required' => $this->isRequired(),
                'type' => $this->getType(),
                'enum' => $this->getEnum()
            ],
        ];

        return $description;
    }

}
