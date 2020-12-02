<?php

namespace App\Form;

use App\Entity\Photo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Abstract type for <code>Photo</code> files (the photo per se and the json 
 * properties).
 *
 * @package App\Entity\MediaObject
 */
final class PhotoType extends AbstractType {

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
                'file', 
                FileType::class, 
                [
                    'label' => 'label.file',
                    'required' => false,
                ]
        );

       // The uploaded JSON property file.
       $builder
            ->add(
                'json',
                 FileType::class, 
                [
                    'label' => 'label.json',
                    'required' => false,
                ]
            )
        ;
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Photo::class,
            'csrf_protection' => false,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix() {
        return '';
    }

}

