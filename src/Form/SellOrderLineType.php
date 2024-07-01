<?php

namespace App\Form;

use App\Entity\Piece;
use App\Entity\SellOrderLine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellOrderLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount')
            ->add('price')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('detail')
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SellOrderLine::class,
        ]);
    }
}
