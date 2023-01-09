<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\RepeatedEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    // Création des événements
    const EVENTS = [
        [
            'start' => '2023-01-14 09:00:00',
            'end' => '2023-01-14 18:00:00',
            'color' => '#FFFF00',
            'description' => 'Spéciale découverte',
            'dance_class' => 'Zumba'
        ],
        [
            'start' => '2023-02-18 14:00:00',
            'end' => '2023-02-18 18:00:00',
            'color' => '#CC99FF',
            'description' => 'Spécial découverte',
            'dance_class' => 'Jazz'
        ],
        [
            'start' => '2023-03-11 14:00:00',
            'end' => '2023-03-11 18:00:00',
            'color' => '#CC3333',
            'description' => 'Spécial découverte',
            'dance_class' => 'Breakdance'
        ],
    ];

    // Création d'événements répétitifs
    const REPEAT_EVENTS = [
        [
            'start' => '2023-01-01 00:00:00',
            'end' => '2024-01-03 23:59:59',
            'color' => '#FF6600',
            'description' => 'Débutants',
            'dance_class' => 'Danse africaine',
            'day_of_week' => 'thursday',
            'start_hour' => '19',
            'start_minute' => '0',
            'end_hour' => '20',
            'end_minute' => '0'
        ],
        [
            'start' => '2023-01-02 00:00:00',
            'end' => '2024-01-03 23:59:59',
            'color' => '#CCCC00',
            'description' => 'Avancés',
            'dance_class' => 'Jazz',
            'day_of_week' => 'tuesday',
            'start_hour' => '18',
            'start_minute' => '0',
            'end_hour' => '19',
            'end_minute' => '0'
        ],
        [
            'start' => '2023-01-01 00:00:00',
            'end' => '2024-01-03 23:59:59',
            'color' => '#FFFF00',
            'description' => 'Intermédiaires',
            'dance_class' => 'Danse Bollywood',
            'day_of_week' => 'friday',
            'start_hour' => '21',
            'start_minute' => '0',
            'end_hour' => '22',
            'end_minute' => '0'
        ],
        [
            'start' => '2023-01-04 00:00:00',
            'end' => '2024-01-04 23:59:59',
            'color' => '#FF3300',
            'description' => 'Avancés',
            'dance_class' => 'Flamenco',
            'day_of_week' => 'wednesday',
            'start_hour' => '20',
            'start_minute' => '0',
            'end_hour' => '21',
            'end_minute' => '0'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        
        foreach (self::EVENTS as $events) {
            $newEvents = new Event();
            $newEvents
                ->setStart(new \DateTime($events['start']))
                ->setEnd(new \DateTime($events['end']))
                ->setColor($events['color'])
                ->setDescription($events['description']);
            $newEvents->setDanceClasses($this->getReference('dance_classes_' . $events['dance_class']));

            
            $manager->persist($newEvents);
        }
        $manager->flush();

        foreach (self::REPEAT_EVENTS as $repeat_events) {
            $new_repeat_events = new RepeatedEvent();
            $new_repeat_events
                ->setStart(new \DateTime($repeat_events['start']))
                ->setEnd(new \DateTime($repeat_events['end']))
                ->setColor($repeat_events['color'])
                ->setDescription($repeat_events['description'])
                ->setDayOfWeek($repeat_events['day_of_week'])
                ->setStartHour($repeat_events['start_hour'])
                ->setStartMinute($repeat_events['start_minute'])
                ->setEndHour($repeat_events['end_hour'])
                ->setEndMinute($repeat_events['end_minute']);
            $new_repeat_events->setDanceClasses($this->getReference('dance_classes_' . $repeat_events['dance_class']));

            
            $manager->persist($new_repeat_events);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EventFixtures dépend
        return [
          DanceClassesFixtures::class,
        ];

    }
}
