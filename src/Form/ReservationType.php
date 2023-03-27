<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_start',DateTimeType::class, [
                'data' => new \DateTimeImmutable('now'),
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker']
            ])
            ->add('date_end',DateTimeType::class,[
                'data' => new \DateTimeImmutable('+1 week'),
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker']
            ])
            ->add('message',TextType::class,[
                'attr' => [
                    'placeholder' => "Message de reservation"
                ]
            ])
            // ->add('appartment')
            // ->add('reservedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
