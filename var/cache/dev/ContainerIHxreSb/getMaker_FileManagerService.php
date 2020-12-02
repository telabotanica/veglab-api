<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'maker.file_manager' shared service.

include_once \dirname(__DIR__, 4).'/vendor/symfony/maker-bundle/src/FileManager.php';
include_once \dirname(__DIR__, 4).'/vendor/symfony/maker-bundle/src/Util/AutoloaderUtil.php';
include_once \dirname(__DIR__, 4).'/vendor/symfony/maker-bundle/src/Util/ComposerAutoloaderFinder.php';

return $this->privates['maker.file_manager'] = new \Symfony\Bundle\MakerBundle\FileManager(($this->services['filesystem'] ?? ($this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem())), new \Symfony\Bundle\MakerBundle\Util\AutoloaderUtil(new \Symfony\Bundle\MakerBundle\Util\ComposerAutoloaderFinder('App')), \dirname(__DIR__, 4), (\dirname(__DIR__, 4).'/templates'));
