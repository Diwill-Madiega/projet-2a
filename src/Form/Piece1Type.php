<?php

namespace App\Form;

use App\Entity\Piece;
use App\Entity\Gamme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class Piece1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('name')
            ->add('buy_price')
            // ->add('gamme_name')
            // ->add('gamme_desc')
            ->add('gamme', EntityType::class, [
                'class' => Gamme::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Sélectionner',
            ])
            ->add('unit')
            ->add('stock')
            ->add('sell_price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
        ]);
    }
}
