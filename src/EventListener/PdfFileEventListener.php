<?php

namespace App\EventListener;

use App\Entity\PdfFile;
use App\TelaBotanica\Eflore\Api\EfloreApiClient;

use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Routing\RequestContext;

/**
 * Populates various properties of <code>PdfFile</code> instances before they 
 * are persisted. The properties are 'url'.
 *
 * @package App\EventListener
 */
class PdfFileEventListener {

    private $uploaderHelper;
    private $requestContext;

    public function __construct(UploaderHelper $uploaderHelper, RequestContext $requestContext) {
        $this->uploaderHelper = $uploaderHelper;
		$this->requestContext = $requestContext;
    }

    /**
     * Populates 'url' and exif related properties of <code>PdfFile</code>
     * instances  before they are persisted.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function prePersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();

        // only act on some "PdfFile" entity
        if (!$entity instanceof PdfFile) {
            return;
        }

      $imgUrl = $this->getHostUrl() . $this->uploaderHelper->asset($entity, 'file');
      $entity->setUrl($imgUrl);
    }

    /**
     * Returns the host URL (<scheme>://<host>:<port>).
     *
     * @return string the host URL.
     */
    private function getHostUrl(): string {
        $scheme = $this->requestContext->getScheme();
        $url = $scheme.'://'.$this->requestContext->getHost();
        $httpPort = $this->requestContext->getHttpPort();
        if ('http' === $scheme && $httpPort && 80 !== $httpPort) {
            return $url.':'.$httpPort;
        }
        $httpsPort = $this->requestContext->getHttpsPort();
        if ('https' === $scheme && $httpsPort && 443 !== $httpsPort) {
            return $url.':'.$httpsPort;
        }
        return $url;
    }

}
