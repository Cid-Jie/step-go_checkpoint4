<?php

namespace App\DataFixtures;

use App\Entity\DanceTeacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DanceTeacherFixtures extends Fixture
{
    const TEACHERS = [
        ['firstname' => 'John',
        'lastname' => 'Doe',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Jazz'
        ],
        ['firstname' => 'John',
        'lastname' => 'Doe',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Modern\' Jazz'
        ],
        ['firstname' => 'Annete',
        'lastname' => 'Black',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' => 'Flamenco'
        ],
        ['firstname' => 'Courtney',
        'lastname' => 'Henry',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' => 'Danse africaine'
        ],
        ['firstname' => 'Courtney',
        'lastname' => 'Henry',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' => 'Zumba'
        ],
        ['firstname' => 'Esther',
        'lastname' => 'Howard',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse contemporaine'
        ],        
        ['firstname' => 'Leslie',
        'lastname' => 'Alexander',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse Bollywood'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TEACHERS as $danceTeachers) {
            $teacher = new DanceTeacher();
            $teacher->setFirstname($danceTeachers['firstname']);
            $teacher->setLastname($danceTeachers['lastname']);
            $teacher->setStory($danceTeachers['story']);
            $teacher->setDanceClasses($this->getReference('dance_classes_' . $danceTeachers['dance_classes_id']));

            $manager->persist($teacher);
        }
        $manager->flush();
    }
}