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
interface FilterDescriptionInterface {

    public function getTextDescription() : string;
    public function getType() : string;
    public function getPropertyName() : string;
    public function isRequired() : bool;

}
