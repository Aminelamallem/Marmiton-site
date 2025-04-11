<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Recette;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('username')
            ->add('message', null, [
                'label' => 'Commentaire',
                'attr' => [
                    'placeholder' => 'Ecrivez votre commentaire ici',
                    'class' => 'form-control'
                ]
            ])
            
            // ->add('created_at', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('recettes', EntityType::class, [
            //     'class' => Recette::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
