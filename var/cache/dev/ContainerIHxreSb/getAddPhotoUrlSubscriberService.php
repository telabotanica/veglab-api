<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\EventSubscriber\AddPhotoUrlSubscriber' shared autowired service.

include_once \dirname(__DIR__, 4).'/vendor/jms/serializer/src/JMS/Serializer/EventDispatcher/EventSubscriberInterface.php';
include_once \dirname(__DIR__, 4).'/src/EventSubscriber/AddPhotoUrlSubscriber.php';

return $this->privates['App\\EventSubscriber\\AddPhotoUrlSubscriber'] = new \App\EventSubscriber\AddPhotoUrlSubscriber(($this->services['vich_uploader.templating.helper.uploader_helper'] ?? $this->getVichUploader_Templating_Helper_UploaderHelperService()), ($this->privates['router.request_context'] ?? $this->getRouter_RequestContextService()));
