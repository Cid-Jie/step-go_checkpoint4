<?php

namespace App\DataFixtures;

use App\Entity\DanceTeacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DanceTeacherFixtures extends Fixture
{
    const TEACHERS = [
        ['firstname' => 'Clara',
        'lastname' => 'Massonnet',
        'photo' => 'https://images.pexels.com/photos/449977/pexels-photo-449977.jpeg',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Modern\' Jazz'
        ],
        ['firstname' => 'Isabelle',
        'lastname' => 'Rossignol',
        'photo' => 'https://images.pexels.com/photos/14795388/pexels-photo-14795388.png',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Jazz', 
        ],
        ['firstname' => 'Monica',
        'lastname' => 'Iglesias',
        'photo' => 'https://images.pexels.com/photos/1674324/pexels-photo-1674324.jpeg',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' => 'Flamenco'
        ],
        ['firstname' => 'William',
        'lastname' => 'Benanga',
        'photo' => 'https://images.pexels.com/photos/7148913/pexels-photo-7148913.jpeg',
        'story' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing',
        'dance_classes_id' => 'Danse africaine',
        ],
        ['firstname' => 'Charlotte',
        'lastname' => 'Vinet',
        'photo' => 'https://images.pexels.com/photos/6453882/pexels-photo-6453882.jpeg',
        'story' => 'Petite, Charlotte a beaucoup pratiqué la danse classique et les danses latines. Elle a même été championne de France de salsa à l\'âge de 14 ans. Elle s\'est ensuite tournée vers le sport et est devenue professeur de Fitness pendant plusieurs années. Depuis 2019, Charlotte mêle ses deux passions, la danse et le fitness, en donnant des cours de Zumba. Ses cours sont accessibles à tous les niveaux. Son objectif est que chacun s\'amuse, et que l\'effort devienne agréable.',
        'dance_classes_id' =>  'Zumba'
        ],
        ['firstname' => 'Chris',
        'lastname' => 'Jennings',
        'photo' => 'https://images.pexels.com/photos/14849514/pexels-photo-14849514.jpeg',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse contemporaine'
        ],        
        ['firstname' => 'Priya',
        'lastname' => 'Devi',
        'photo' => 'https://images.pexels.com/photos/14829695/pexels-photo-14829695.jpeg',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse Bollywood'
        ],
        ['firstname' => 'Soraya',
        'lastname' => 'Benassi',
        'photo' => 'https://images.pexels.com/photos/13975351/pexels-photo-13975351.jpeg',
        'story' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'dance_classes_id' => 'Danse orientale'
        ],
        ['firstname' => 'David',
        'lastname' => 'Jarny',
        'photo' => 'https://images.pexels.com/photos/3026284/pexels-photo-3026284.jpeg',
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