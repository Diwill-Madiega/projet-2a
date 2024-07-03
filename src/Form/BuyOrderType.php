<?php

// src/Form/BuyOrderType.php

namespace App\Form;

use App\Entity\Furnisher;
use App\Entity\BuyOrder;
use App\Form\BuyOrderLineType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuyOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date')
            ->add('buyOrderLines', CollectionType::class, [
                'entry_type' => BuyOrderLineType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'attr' => [
                    'class' => 'buy-order-lines',
                ],
            ])
            ->add('furnisher', EntityType::class, [
                'class' => Furnisher::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BuyOrder::class,
        ]);
    }
}
