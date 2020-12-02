<?php

namespace App\EventSubscriber;

use App\Entity\Photo;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GenericSerializationVisitor;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\Routing\RequestContext;

class AddPhotoUrlSubscriber implements EventSubscriberInterface {

	private $uploaderHelper;

	public function __construct(UploaderHelper $uploaderHelper, RequestContext $requestContext) {
		$this->uploaderHelper = $uploaderHelper;
		$this->requestContext = $requestContext;
	}

	public function onPreSerialize(PreSerializeEvent $event) {

		$object = $event->getObject();
		$visitor = $event->getVisitor();
		/* @var $visitor GenericSerializationVisitor */
		$url = $this->getHostUrl() . $this->uploaderHelper->asset($object, 'file');
		$visitor->setData('absoluteUrl', $url);
	}

    public static function getSubscribedEvents(): array {
        return [
            ['event' => Events::PRE_SERIALIZE, 'method' => 'onPreSerialize', 'class' => Photo::class],
        ];
    }

    /**
     * Get host url (scheme://host:port).
     *
     * @return string
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
