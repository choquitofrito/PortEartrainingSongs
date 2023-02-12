<?php

namespace App\Form;

use App\Entity\Song;
use App\Entity\Library;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('originalTempo')
            ->add('originalTonality')
            ->add('fileLink', FileType::class, [
                'label' => "Select audio file",
                'mapped' => false, // recovered with $form['fileLink']->getData()
                'required' => false 
            ])
            ->add('library', EntityType::class, [
                // looks for choices from this entity
                'class' => Library::class,
                'choice_label' => 'name'

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }
}
