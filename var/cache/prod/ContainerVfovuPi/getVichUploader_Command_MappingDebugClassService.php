<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'vich_uploader.command.mapping_debug_class' shared service.

include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
include_once \dirname(__DIR__, 4).'/vendor/vich/uploader-bundle/Command/MappingDebugClassCommand.php';

$this->privates['vich_uploader.command.mapping_debug_class'] = $instance = new \Vich\UploaderBundle\Command\MappingDebugClassCommand(($this->privates['vich_uploader.metadata_reader'] ?? $this->getVichUploader_MetadataReaderService()));

$instance->setName('vich:mapping:debug-class');

return $instance;
