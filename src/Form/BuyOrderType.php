<?php

namespace App\Form;

use App\Entity\BuyOrder;
use App\Entity\Furnisher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BuyOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('amount')
            ->add('type')
            ->add('date')

            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'matière première' => 'matière première',
                    'intermédiaire' => 'intermédiaire',
                    'achetée' => 'achetée',
                ],
                'placeholder' => 'Sélectionnez un type',
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])

            ->add('furnisher', EntityType::class, [
                'class' => Furnisher::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez un fournisseur',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BuyOrder::class,
        ]);
    }
}
