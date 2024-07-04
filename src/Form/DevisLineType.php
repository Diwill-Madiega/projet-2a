<?php

namespace App\Form;

use App\Entity\DevisLine;
use App\Entity\Piece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('piece', EntityType::class, [
            'class' => Piece::class,
            'choice_label' => 'name',
            'placeholder' => 'Sélectionner une pièce',
            'attr' => ['class' => 'form-control'],
            'label' => 'Pièce',
        ])
            ->add('amount', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Quantité',
            ])
            ->add('price', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prix',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DevisLine::class,
        ]);
    }
}
