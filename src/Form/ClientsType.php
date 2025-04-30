<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ClientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'label' => 'Nom complet',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone',
                'required' => true,
            ])
            ->add('quartier', TextType::class, [
                'label' => 'Quartier',
                'required' => false,
            ])
            ->add('commune', TextType::class, [
                'label' => 'Commune',
                'required' => false,
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Particulier' => 'particulier',
                    'Entreprise' => 'entreprise',
                    // Ajoute d'autres catégories si besoin
                ],
                'required' => true,
                'placeholder' => 'Sélectionner une catégorie',
            ])
            ->add('enfants', CollectionType::class, [
                'entry_type' => EnfantsType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Enfants',
                'required' => false,
                'prototype' => true,
            ])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
