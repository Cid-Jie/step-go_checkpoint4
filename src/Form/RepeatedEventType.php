<?php

namespace App\Form;

use App\Entity\RepeatedEvent;
use App\Service\NumberSelectService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepeatedEventType extends EventType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Event', BaseEventType::class, [
                    'data_class' => RepeatedEvent::class,
            ])
            ->add('dayOfWeek', ChoiceType::class, [
                'label' => 'Jour de la semaine',
                'choices'  => [
                    'Lundi' => 'lundi',
                    'Mardi' => 'mardi',
                    'Mercredi' => 'mercredi',
                    'Jeudi' => 'jeudi',
                    'Vendredi' => 'vendredi',
                    'Samedi' => 'samedi',
                    'Dimanche' => 'dimanche',   
                ],
            ])
            ->add('startHour', ChoiceType::class, [
                'label' => 'Heure de début',
                'choices'  => NumberSelectService::getChoiceNumber(23)
            ])
            ->add('startMinute', ChoiceType::class, [
                'choices'  => NumberSelectService::getChoiceNumber(59)
            ])
            ->add('endHour', ChoiceType::class, [
                'label' => 'Heure de fin',
                'choices'  => NumberSelectService::getChoiceNumber(23)
            ])
            ->add('endMinute', ChoiceType::class, [
                'choices'  => NumberSelectService::getChoiceNumber(59)
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => RepeatedEvent::class,
        ]);
    }
}
