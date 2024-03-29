<?php

namespace App\Form;

use App\Entity\DanceClasses;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color', ColorType::class, [
                'label' => 'Couleur',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('danceClasses', EntityType::class, [
                'required' => false,
                'class' => DanceClasses::class,
                'choice_label' => 'name',
                'label' => 'Cours de danse : ',
                'placeholder' => 'Choisir un cours de danse'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'inherit_data' => true,
        ]);
    }
    
}