<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class BiblioPhyto extends \App\Entity\BiblioPhyto implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'id', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'title', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'occurrences', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'tables', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'syes', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'syntheticColumns', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'pdfFiles'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'id', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'title', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'occurrences', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'tables', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'syes', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'syntheticColumns', '' . "\0" . 'App\\Entity\\BiblioPhyto' . "\0" . 'pdfFiles'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (BiblioPhyto $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', []);

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle(string $title): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', [$title]);

        return parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getOccurrences(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOccurrences', []);

        return parent::getOccurrences();
    }

    /**
     * {@inheritDoc}
     */
    public function addOccurrence(\App\Entity\Occurrence $occurrence): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addOccurrence', [$occurrence]);

        return parent::addOccurrence($occurrence);
    }

    /**
     * {@inheritDoc}
     */
    public function removeOccurrence(\App\Entity\Occurrence $occurrence): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeOccurrence', [$occurrence]);

        return parent::removeOccurrence($occurrence);
    }

    /**
     * {@inheritDoc}
     */
    public function getTables(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTables', []);

        return parent::getTables();
    }

    /**
     * {@inheritDoc}
     */
    public function addTable(\App\Entity\Table $table): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTable', [$table]);

        return parent::addTable($table);
    }

    /**
     * {@inheritDoc}
     */
    public function removeTable(\App\Entity\Table $table): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeTable', [$table]);

        return parent::removeTable($table);
    }

    /**
     * {@inheritDoc}
     */
    public function getSyes(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSyes', []);

        return parent::getSyes();
    }

    /**
     * {@inheritDoc}
     */
    public function addSye(\App\Entity\Sye $sye): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSye', [$sye]);

        return parent::addSye($sye);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSye(\App\Entity\Sye $sye): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSye', [$sye]);

        return parent::removeSye($sye);
    }

    /**
     * {@inheritDoc}
     */
    public function getSyntheticColumns(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSyntheticColumns', []);

        return parent::getSyntheticColumns();
    }

    /**
     * {@inheritDoc}
     */
    public function addSyntheticColumn(\App\Entity\SyntheticColumn $sCol): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSyntheticColumn', [$sCol]);

        return parent::addSyntheticColumn($sCol);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSyntheticColumn(\App\Entity\SyntheticColumn $sCol): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSyntheticColumn', [$sCol]);

        return parent::removeSyntheticColumn($sCol);
    }

    /**
     * {@inheritDoc}
     */
    public function getPdfFiles(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPdfFiles', []);

        return parent::getPdfFiles();
    }

    /**
     * {@inheritDoc}
     */
    public function addPdfFile(\App\Entity\PdfFile $pdfFile): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPdfFile', [$pdfFile]);

        return parent::addPdfFile($pdfFile);
    }

    /**
     * {@inheritDoc}
     */
    public function removePdfFile(\App\Entity\PdfFile $pdfFile): \App\Entity\BiblioPhyto
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePdfFile', [$pdfFile]);

        return parent::removePdfFile($pdfFile);
    }

}
