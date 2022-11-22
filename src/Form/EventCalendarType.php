<?php

namespace App\Form;

use App\Entity\DanceClasses;
use App\Entity\EventCalendar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventCalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TypeTextType::class, [
                'label' => 'Titre de l\'événement',
            ])
            ->add('start', DateTimeType::class, [
                'label' => 'Date et heure de départ',
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Date et heure de départ',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('is_all_day', ChoiceType::class, [
                'label' => 'Toute la journée'
            ])
            ->add('background_color', ColorType::class, [
                'label' => 'Couleur de l\'événement'
            ])
            ->add('danceClasses', EntityType::class, [
                'class' => DanceClasses::class,
                'choice_label' => 'name',
                'label' => 'Cours de danse'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventCalendar::class,
        ]);
    }
}
