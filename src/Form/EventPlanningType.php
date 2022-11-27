<?php

namespace App\Form;

use App\Entity\DanceClasses;
use App\Entity\EventPlanning;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventPlanningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('days_of_week', ChoiceType::class, [
                'label' => 'Jour de la semaine: ',
                'choices' => [
                    'Lundi' => 1,
                    'Mardi' => 2,
                    'Mercredi' => 3,
                    'Jeudi' => 4,
                    'Vendredi' => 5,
                ],
                'required' => true
            ])
            ->add('hoursOfDay', ChoiceType::class, [
                'label' => 'Créneau horaire: ',
                'choices' => [
                    '18h - 19h' => 1,
                    '19h - 20h' => 2,
                    '20h - 21h' => 3,
                    '21h - 22h' => 4,
                ],
                'required' => true
            ])
            ->add('danceClasses', EntityType::class, [
                'class' => DanceClasses::class,
                'choice_label' => 'name',
                'label' => 'Cours de danse : '
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description : '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventPlanning::class,
        ]);
    }
}
