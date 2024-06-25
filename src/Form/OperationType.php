<?php

namespace App\Form;

use App\Entity\Operation;
use App\Entity\Post;
use App\Entity\Machine;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class OperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('duration')
            ->add('post', EntityType::class, [
                'class' => Post::class,
                'choice_label' => 'name',
                'placeholder' => "Poste",
                'attr' => ['autocomplete' => 'off']
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $operation = $event->getData();

            $post = $operation->getPost();

            $form->add('machine', EntityType::class, [
                'class' => Machine::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => "Machine",
                'query_builder' => function (EntityRepository $er) use ($post) {
                    return $er->createQueryBuilder('m')
                        ->join('m.posts', 'p')
                        ->where('p.id = :post_id')
                        ->setParameter('post_id', $post->getId());
                },
            ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
        ]);
    }
}
