<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Appartment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AppartmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextType::class,[
            'attr' => [
                'placeholder' => "Entrez le nom de l'annonce"
            ]
        ])
        ->add('description',TextareaType::class,[
            'attr' => [
                'placeholder' => "Entrez la description de l'annonce"
            ]
        ])
        ->add('imageUrl',FileType::class,[
            ##Multiple image
            // 'label'=>false,
            // 'mapped'=>false,
            // 'required'=>false,
            // 'multiple' => true
        ])

        ->add('category',EntityType::class,[
            'class' => Category::class,
            'choice_label' => 'title',

            'label' => false,
            'attr' => [
            ]

        ])

        ->add('price',NumberType::class,[
            'attr' => [
                'placeholder' => 'Entrez le prix de votre annonce'
            ]
        ])

        ->add('introduction',TextType::class,[
            'attr' => [
                'placeholder' => 'Entrez une courte descritpion de votre annonce'
            ]
        ])

        ->add('nbRoom',NumberType::class,[
            'attr' => [
                'placeholder' => 'Entrez le nombre de chambre'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appartment::class,
        ]);
    }
}