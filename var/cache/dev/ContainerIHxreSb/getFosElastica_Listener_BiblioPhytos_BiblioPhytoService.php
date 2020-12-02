<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'fos_elastica.listener.biblio_phytos.biblio_phyto' shared service.

include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Doctrine/Listener.php';
include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Provider/IndexableInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/friendsofsymfony/elastica-bundle/src/Provider/Indexable.php';

return $this->privates['fos_elastica.listener.biblio_phytos.biblio_phyto'] = new \FOS\ElasticaBundle\Doctrine\Listener(($this->services['fos_elastica.object_persister.biblio_phytos.biblio_phyto'] ?? $this->load('getFosElastica_ObjectPersister_BiblioPhytos_BiblioPhytoService.php')), ($this->privates['fos_elastica.indexable'] ?? ($this->privates['fos_elastica.indexable'] = new \FOS\ElasticaBundle\Provider\Indexable([]))), ['identifier' => 'id', 'indexName' => 'biblio_phytos', 'typeName' => 'biblio_phyto'], NULL);
