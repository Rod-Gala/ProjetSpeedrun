<?php

namespace App\Form;

use App\Entity\Plateform;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlateformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' =>[
                    'placeholder' => 'Enter the new plateform'
                ]
            ])
            
            //->add('games')

            /* Submit button*/
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'custom_class'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plateform::class,
        ]);
    }
}
