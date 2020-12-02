<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\DataProvider\UserOccurrenceTagCollectionDataProvider' shared autowired service.

include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/DataProvider/RestrictedDataProviderInterface.php';
include_once \dirname(__DIR__, 4).'/src/DataProvider/UserOccurrenceTagCollectionDataProvider.php';

return $this->privates['App\\DataProvider\\UserOccurrenceTagCollectionDataProvider'] = new \App\DataProvider\UserOccurrenceTagCollectionDataProvider(($this->privates['security.helper'] ?? $this->getSecurity_HelperService()), ($this->services['doctrine.orm.default_entity_manager'] ?? $this->getDoctrine_Orm_DefaultEntityManagerService()), ($this->services['request_stack'] ?? ($this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack())));
