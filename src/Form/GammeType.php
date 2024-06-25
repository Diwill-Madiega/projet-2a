<?php

namespace App\Form;

use App\Entity\Gamme;
use App\Entity\Piece;
use App\Entity\User;
use App\Entity\Operation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class GammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('owner', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'attr' => ['autocomplete' => 'off']
            ])
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'name',
                'placeholder' => 'Pièce',
                'attr' => ['autocomplete' => 'off'],
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                              ->leftJoin('p.gamme', 'g')
                              ->where('g.id IS NULL');
                }
            ])
            ->add('operation', EntityType::class, [
                'class' => Operation::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
            ])
        ;
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gamme::class,
        ]);
    }
}
