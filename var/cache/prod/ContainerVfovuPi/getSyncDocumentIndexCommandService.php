<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Elastica\Command\SyncDocumentIndexCommand' shared autowired service.

include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
include_once \dirname(__DIR__, 4).'/src/Elastica/Command/SyncDocumentIndexCommand.php';

$this->privates['App\\Elastica\\Command\\SyncDocumentIndexCommand'] = $instance = new \App\Elastica\Command\SyncDocumentIndexCommand($this);

$instance->setName('cel:sync-es');

return $instance;
