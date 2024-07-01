<?php

namespace App\Form;

use App\Entity\BuyOrderLine;
use App\Entity\Furnisher;
use App\Entity\Piece;
use App\Entity\BuyOrder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuyOrderLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price')
            ->add('amount')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'name',
            ])
            ->add('furnisher', EntityType::class, [
                'class' => Furnisher::class,
                'choice_label' => 'name',
            ])
            ->add('buyOrder', EntityType::class, [
                'class' => BuyOrder::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BuyOrderLine::class,
        ]);
    }
}
