<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomArticle')
            ->add('PrixArticle')
            ->add('QuantiteArticle')
            ->add('Categorie', EntityType::class, [
                        'class' => Categorie::class,
                        'choice_label' => 'NomCategorie',
                        'multiple' => false,
                        'expanded' => false,
                ])
            ->add('pannier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
