<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Patient;
use App\Entity\Therapist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Patient2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Point')
            ->add('Therapist', EntityType::class, [
                'class' => Therapist::class,
                'choice_label' => 'NomTherapist',
                'multiple' => false,
                'expanded' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
