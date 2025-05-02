<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('couleur', ChoiceType::class, [
                'choices' => [
                    'Success' => 'success',
                    'Primary' => 'primary',
                    'Secondary' => 'secondary',
                    'Info' => 'info',
                    'Warning' => 'warning',
                    'Danger' => 'danger',
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => false,
                'choice_attr' => function ($choice, $key, $value) {
                    return [
                        'class' => 'btn-check',
                        'data-kt-button' => 'true',
                    ];
                },
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
