<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Action/controller for POST (CREATE) HTTP requests on <code>Photo</code> 
 * resources.
 *
 * @package App\Controller
 */
final class CreatePhotoAction {

    // Symfony services
    private $validator;
    private $doctrine;
    private $formFactory;
    // the <code>Security</code> service to retrieve the current user:
    protected $security;

    const DUPLICATE_NAME_MSG = "A photo with the same name is already present "
        . "in the user gallery. This is not allowed.";

    /**
     * Returns a new <code>CreatePhotoAction</code> instance 
     * initialized with (injected) services passed as parameters.
     *
     * @param ManagerRegistry $doctrine The injected 
     *        <code>ManagerRegistry</code> service.
     * @param FormFactoryInterface $formFactory The injected 
     *        <code>FormFactoryInterface</code> service.
     * @param Security $security The injected <code>Security</code> service.<
     * @param ValidatorInterface $validator The injected 
     *        <code>ValidatorInterface</code> service.
     * @return CreatePhotoAction Returns a new  
     *         <code>CreatePhotoAction</code> instance initialized 
     *         with (injected) services passed as parameters.
     */
    public function __construct(
        ManagerRegistry $doctrine, 
        Security $security, 
        FormFactoryInterface $formFactory, 
        ValidatorInterface $validator) {
        $this->validator = $validator;
        $this->security = $security;
        $this->doctrine = $doctrine;
        $this->factory = $formFactory;
    }

    /**
     * Invokes the controller/action.
     *
     * @param Request $request The HTTP <code>Request</code> issued 
     *        by the client.
     * 
     * @return Response Returns an HTTP <code>Response</code> reflecting
     *         the action result.
     */
    public function __invoke(Request $request): Photo {

        $photo = new Photo();
        $photoRepo = $this->doctrine->getRepository(Photo::class);
        $form = $this->factory->create(PhotoType::class, $photo);
        $form->handleRequest($request);
        $file = $request->files->get('file');
        $originalName = $file->getClientOriginalName();
        $userId = $this->security->getToken()->getUser()->getId();
        $photoWithSameName = $photoRepo->findByOriginalNameAndUserId($originalName, $userId);

        if ( (sizeof($photoWithSameName)==0) ) {

            $em = $this->doctrine->getManager();
            $em->persist($photo);
            $em->flush();

            // Prevent the serialization of the file property
            $photo->file = null;

            return $photo;
        }

        // This will be handled by API Platform which will return a 
        // validation error:
        throw new \Exception(CreatePhotoAction::DUPLICATE_NAME_MSG);
    }

}


