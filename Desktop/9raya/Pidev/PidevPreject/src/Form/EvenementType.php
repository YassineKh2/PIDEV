<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\Organisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomEvenement')
            ->add('DateEvenement')
            ->add('NombreParticipantEvenement')
            ->add('PrixEvenement')
            ->add('TypeEvenement')
            ->add('Organisateur', EntityType::class ,[
                'class' => Organisateur::class,
                'choice_label'=> 'NomOrganisateur',
                'multiple'=>false,
                'expanded'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
