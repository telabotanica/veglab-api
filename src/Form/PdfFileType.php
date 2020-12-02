<?php

namespace App\Form;

use App\Entity\PdfFile;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Abstract type for <code>PdfFile</code>
 *
 * @package App\Entity\MediaObject
 */
final class PdfFileType extends AbstractType {

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
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => PdfFile::class,
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

