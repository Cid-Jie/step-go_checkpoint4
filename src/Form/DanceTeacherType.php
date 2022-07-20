<?php

namespace App\Form;

use App\Entity\DanceClasses;
use App\Entity\DanceTeacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DanceTeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('story', TextType::class, [
                'label' => 'Histoire',
            ])
            ->add('photo', TextType::class, [
                'label' => 'Photo',
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
            'data_class' => DanceTeacher::class,
        ]);
    }
}
