<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        /* Form's fields */

            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter the name here',
                    'class' => 'custom_class'
                ]
            ])
            ->add ('plateform', TextType::class)
            ->add('rule', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Enter the description here',
                    'class' => 'custome_class'
                ]
            ])
            ->add('year', TextType::class, [
                'attr' =>[
                    'placeholder' => 'Enter the year here'
                ]
            ])
            ->add('users', TextType::class)
            ->add('plateforms', TextType::class)


            /* Submit button*/
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'custom_class'

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
