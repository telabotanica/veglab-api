<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'enqueue_elastica.purge_populate_queue_listener' shared service.

include_once \dirname(__DIR__, 4).'/vendor/enqueue/elastica-bundle/Persister/Listener/PurgePopulateQueueListener.php';

return $this->privates['enqueue_elastica.purge_populate_queue_listener'] = new \Enqueue\ElasticaBundle\Persister\Listener\PurgePopulateQueueListener(($this->privates['enqueue.transport.default.context'] ?? $this->load('getEnqueue_Transport_Default_ContextService.php')));
