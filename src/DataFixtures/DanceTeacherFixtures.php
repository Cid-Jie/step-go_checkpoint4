<?php

namespace App\DataFixtures;

use App\Entity\DanceTeacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DanceTeacherFixtures extends Fixture
{
    const TEACHERS = [
        ['firstname' => 'Jane',
        'lastname' => 'Doe',
        'photo' => 'https://i.pravatar.cc/300',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Modern\' Jazz'
        ],
        ['firstname' => 'Helen',
        'lastname' => 'Doe',
        'photo' => 'https://i.pravatar.cc/300',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Jazz', 
        ],
        ['firstname' => 'Annete',
        'lastname' => 'Black',
        'photo' => 'https://i.pravatar.cc/301',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' => 'Flamenco'
        ],
        ['firstname' => 'Bessie',
        'lastname' => 'Cooper',
        'photo' => 'https://i.pravatar.cc/302',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' => 'Danse africaine',
        ],
        ['firstname' => 'Jean',
        'lastname' => 'Dupont',
        'photo' => 'https://i.pravatar.cc/302',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' =>  'Zumba'
        ],
        ['firstname' => 'Darlene',
        'lastname' => 'Robertson',
        'photo' => 'https://i.pravatar.cc/303',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse contemporaine'
        ],        
        ['firstname' => 'Leslie',
        'lastname' => 'Alexander',
        'photo' => 'https://i.pravatar.cc/304',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse Bollywood'
        ],
        ['firstname' => 'Esther',
        'lastname' => 'Howard',
        'photo' => 'https://i.pravatar.cc/305',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse orientale'
        ],
        ['firstname' => 'Brooklyn',
        'lastname' => 'Simmons',
        'photo' => 'https://i.pravatar.cc/306',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Breakdance'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TEACHERS as $danceTeachers) {
            $teacher = new DanceTeacher();
            $teacher->setFirstname($danceTeachers['firstname']);
            $teacher->setLastname($danceTeachers['lastname']);
            $teacher->setStory($danceTeachers['story']);
            $teacher->setPhoto($danceTeachers['photo']);
            $teacher->setDanceClasses($this->getReference('dance_classes_' . $danceTeachers['dance_classes_id']));

            $manager->persist($teacher);
        }
        $manager->flush();
    }
}