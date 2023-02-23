<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Therapist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TherapistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NumTelTherapist')
            ->add('IdUtilisateur')
            ->add('Adresse', EntityType::class, [
                'class' => Adresse::class,
                'choice_label' => 'id',
                'multiple' => false,
                'expanded' => false, ]
            );

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Therapist::class,
        ]);
    }
}
