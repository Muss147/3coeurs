<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Enfants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EnfantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nnomCompletom', TextType::class, [
                'label' => 'Nom de l\'enfant',
                'required' => true,
            ])
            ->add('age')
            ->add('taille')
            ->add('pointure')
            ->add('parent', EntityType::class, [
                'class' => Clients::class,
                'choice_label' => 'id',
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
