<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Filter\Occurrence\DateObservedDayFilter' shared autowired service.

include_once \dirname(__DIR__, 4).'/src/Filter/FilterDescriptionInterface.php';
include_once \dirname(__DIR__, 4).'/src/Filter/BaseFilter.php';
include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Api/FilterInterface.php';
include_once \dirname(__DIR__, 4).'/src/Filter/Occurrence/DateObservedDayFilter.php';

return $this->privates['App\\Filter\\Occurrence\\DateObservedDayFilter'] = new \App\Filter\Occurrence\DateObservedDayFilter();
