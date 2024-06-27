<?php

namespace App\Form;

use App\Entity\Rights;
use App\Entity\User;
use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstName', null, [
            'attr' => ['class' => 'form-control']
            ])

            ->add('lastName', null, [
            'attr' => ['class' => 'form-control']
            ])

            ->add('email', null, [
                'attr' => ['class' => 'form-control']
            ])

            ->add('password', null, [
                'mapped' => false,
                'required' => true,

                'attr' => [
                    'required' => false,
                    'class' => 'form-control',
                    'autocomplete' => 'new-password',
                ],
            ])

            ->add('Rights', EntityType::class, [
                'class' => Rights::class,
                'choice_label' => 'role_name',
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'Sélectionnez un rôle',
            ])

            ->add('qualification', EntityType::class, [
                'class' => Post::class,
                'choice_label' => 'name',
                'required' => false,
                'multiple' => 'true',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => true,
        ]);
    }
}
