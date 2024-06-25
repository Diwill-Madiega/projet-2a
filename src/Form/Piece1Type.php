<?php
// src/Form/PieceType.php

namespace App\Form;

use App\Entity\Piece;
use App\Entity\Gamme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class Piece1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('name')
            ->add('buy_price', NumberType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('sell_price', NumberType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('gamme', EntityType::class, [
                'class' => Gamme::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Gamme',
            ])

            ->add('subpieces', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'name',
                'required' => false,
                'multiple' => 'true',
            ])

            ->add('unit')
            ->add('stock')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'matière première' => 'matière première',
                    'intermédiaire' => 'intermédiaire',
                    'achetée' => 'achetée',
                    'livrable' => 'livrable',
                ],
                'placeholder' => 'Sélectionnez un type',
                'required' => true,
                'attr' => ['class' => 'form-control']
            ]);

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if (!$data || null === $data->getType()) {
                $form->add('buy_price', NumberType::class, [
                    'required' => false,
                    'attr' => ['class' => 'form-control', 'disabled' => 'disabled']
                ])->add('sell_price', NumberType::class, [
                    'required' => false,
                    'attr' => ['class' => 'form-control', 'disabled' => 'disabled']
                ]);
                return;
            }

            switch ($data->getType()) {
                case 'matière première':
                case 'achetée':
                    $form->add('buy_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])->add('sell_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control', 'disabled' => 'disabled']
                    ]);
                    break;
                case 'intermédiaire':
                    $form->add('buy_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])->add('sell_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ]);
                    break;
                case 'livrable':
                    $form->add('buy_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control', 'disabled' => 'disabled']
                    ])->add('sell_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ]);
                    break;
                default:
                    $form->add('buy_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control', 'disabled' => 'disabled']
                    ])->add('sell_price', NumberType::class, [
                        'required' => false,
                        'attr' => ['class' => 'form-control', 'disabled' => 'disabled']
                    ]);
                    break;
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
        ]);
    }
}