<?php

namespace App\Form;

use App\Entity\DanceClasses;
use App\Entity\UserMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom : '
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom : '
            ])
            ->add('email', TextType::class, [
                'label' => 'Email : '
            ])
            ->add('reason', ChoiceType::class, [
                'label' => 'Raison du contact : ',
                'choices' => [
                    'Renseignements' => 'Renseignements',
                    'Inscription' => 'Inscription',
                    'Financement' => 'Financement',
                    'Autre demande' => 'Autre demande',
                ],
            ])
            ->add('danceClasses', null, [
                'class' => DanceClasses::class,
                'choice_label' => 'name',
                'label' => 'Cours de danse concerné : ',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message : '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserMessage::class,
        ]);
    }
}
