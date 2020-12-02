<?php

namespace App\Controller;

use App\Entity\PdfFile;
use App\Form\PdfFileType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;
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
final class CreatePdfFileAction {

    // Symfony services
    private $validator;
    private $doctrine;
    private $formFactory;

    /**
     * Returns a new <code>CreatePhotoAction</code> instance 
     * initialized with (injected) services passed as parameters.
     *
     * @param ManagerRegistry $doctrine The injected 
     *        <code>ManagerRegistry</code> service.
     * @param FormFactoryInterface $formFactory The injected 
     *        <code>FormFactoryInterface</code> service.
     * @param ValidatorInterface $validator The injected 
     *        <code>ValidatorInterface</code> service.
     * @return CreatePhotoAction Returns a new  
     *         <code>CreatePhotoAction</code> instance initialized 
     *         with (injected) services passed as parameters.
     */
    public function __construct(
        ManagerRegistry $doctrine, 
        FormFactoryInterface $formFactory, 
        ValidatorInterface $validator) {

        $this->validator = $validator;
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
    public function __invoke(Request $request): PdfFile {

        $pdfFile = new PdfFile();
        //$pdfFileRepo = $this->doctrine->getRepository(PdfFile::class);
        $form = $this->factory->create(PdfFileType::class, $pdfFile);
        $form->handleRequest($request);
        $file = $request->files->get('file');
        //$originalName = $file->getClientOriginalName();
        //$findByArray = array('originalName' => $originalName);

        //if ( (sizeof($photoWithSameName)==0) ) {

            $em = $this->doctrine->getManager();
            $em->persist($pdfFile);
            $em->flush();

            // Prevent the serialization of the file property
            $pdfFile->file = null;

            return $pdfFile;
        //}
    }

}


