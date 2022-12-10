<?php

namespace App\Form;

use App\Entity\DanceClasses;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('start', DateTimeType::class, [
                'label' => 'Début',
                'date_widget' => 'single_text'
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Fin',
                'date_widget' => 'single_text'
            ])
            ->add('color', ColorType::class, [
                'label' => 'Couleur',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('timed', ChoiceType::class, [
                'label' => 'Toute la journée',
                'choices'  => [
                    'oui' => true,
                    'non' => false,
                ],
            ])
            ->add('danceClasses', EntityType::class, [
                'class' => DanceClasses::class,
                'choice_label' => 'name',
                'label' => 'Cours de danse : '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
