<?php

namespace App\Form;

use App\Entity\Machine;
use App\Entity\Post;
use App\Entity\Production;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('duration')
            ->add('post', EntityType::class, [
                'class' => Post::class,
                'choice_label' => 'name',
            ])
            ->add('machine', EntityType::class, [
                'class' => Machine::class,
                'choice_label' => 'name',
            ])
            ->add('creator', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Production::class,
        ]);
    }
}
