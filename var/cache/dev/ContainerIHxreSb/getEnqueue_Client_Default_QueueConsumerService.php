<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'enqueue.client.default.queue_consumer' shared service.

include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/QueueConsumerInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/QueueConsumer.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/StartExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/PreSubscribeExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/PreConsumeExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/MessageReceivedExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/PostMessageReceivedExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/MessageResultExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/ProcessorExceptionExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/PostConsumeExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/EndExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/InitLoggerExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/ExtensionInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/ChainExtension.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Client/ConsumptionExtension/SetRouterPropertiesExtension.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Client/ConsumptionExtension/ExclusiveCommandExtension.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Client/ConsumptionExtension/FlushSpoolProducerExtension.php';
include_once \dirname(__DIR__, 4).'/vendor/enqueue/enqueue/Consumption/Extension/ReplyExtension.php';

$a = ($this->privates['enqueue.client.default.driver'] ?? $this->getEnqueue_Client_Default_DriverService());

return $this->privates['enqueue.client.default.queue_consumer'] = new \Enqueue\Consumption\QueueConsumer(($this->privates['enqueue.client.default.context'] ?? $this->getEnqueue_Client_Default_ContextService()), new \Enqueue\Consumption\ChainExtension([0 => new \Enqueue\Client\ConsumptionExtension\SetRouterPropertiesExtension($a), 1 => new \Enqueue\Client\ConsumptionExtension\ExclusiveCommandExtension($a), 2 => ($this->privates['enqueue.consumption.reply_extension'] ?? ($this->privates['enqueue.consumption.reply_extension'] = new \Enqueue\Consumption\Extension\ReplyExtension())), 3 => new \Enqueue\Client\ConsumptionExtension\FlushSpoolProducerExtension(($this->privates['enqueue.client.default.spool_producer'] ?? $this->load('getEnqueue_Client_Default_SpoolProducerService.php')))]), [], ($this->privates['monolog.logger'] ?? $this->getMonolog_LoggerService()), 10000);
