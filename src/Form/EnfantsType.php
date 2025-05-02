<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Enfants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EnfantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Nom complet', 'class' => 'form-control mb-2 mb-md-0'],
            ])
            ->add('age', IntegerType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Âge', 'class' => 'form-control mb-2 mb-md-0'],
            ])
            ->add('taille', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Taille', 'class' => 'form-control mb-2 mb-md-0'],
            ])
            ->add('pointure', IntegerType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Pointure', 'class' => 'form-control mb-2 mb-md-0'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enfants::class,
        ]);
    }
}
