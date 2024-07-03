<?php

// src/Form/BuyOrderLineType.php

namespace App\Form;

use App\Entity\BuyOrderLine;
use App\Entity\Furnisher;
use App\Entity\Piece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BuyOrderLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'placeholder' => "Sélectionner une pièce",
            ])
            ->add('price', NumberType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('amount', NumberType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
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
            'data_class' => BuyOrderLine::class,
        ]);
    }
}