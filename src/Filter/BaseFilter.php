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
abstract class BaseFilter implements FilterDescriptionInterface {

    private $textDescription;
    private $type;
    private $propertyName;
    private $isRequired;

    function __construct(
        string $propertyName, string $type, 
        string $textDescription, bool $isRequired) {

        $this->propertyName = $propertyName;
        $this->type = $type;
        $this->textDescription = $textDescription;
        $this->isRequired = $isRequired;
    }

    public function getTextDescription() : string {
        return $this->textDescription;
    }

    public function getType() : string {
        return $this->type;
    }

    public function getPropertyName() : string {
        return $this->propertyName;
    }

    public function isRequired() : bool {
        return $this->isRequired;
    }

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
                'type' => $this->getType()
            ],
        ];

        return $description;
    }

}
