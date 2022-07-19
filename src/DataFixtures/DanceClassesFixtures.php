<?php

namespace App\DataFixtures;

use App\Entity\DanceClasses;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DanceClassesFixtures extends Fixture 
{
    const CLASSES = [
        ['name' => 'Jazz',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'poster' => "https://cdn.pixabay.com/photo/2020/01/05/20/51/jazz-4744078_960_720.jpg"
        ],
        ['name' => 'Modern\' Jazz',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'poster' => "https://images.pexels.com/photos/6215517/pexels-photo-6215517.jpeg"
        ],
        ['name' => 'Breakdance',
        'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'poster' => "https://cdn.pixabay.com/photo/2017/06/23/10/19/dance-2434199_960_720.jpg"
        ],
        ['name' => 'Danse contemporaine',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'poster' => "https://images.pexels.com/photos/6769375/pexels-photo-6769375.jpeg"
        ],
        ['name' => 'Danse orientale',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'poster' => "https://cdn.pixabay.com/photo/2020/05/01/16/23/bellydancer-5117914_960_720.jpg"
        ],
        ['name' => 'Flamenco',
        'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'poster' => "https://images.pexels.com/photos/5005535/pexels-photo-5005535.jpeg"
        ],
        ['name' => 'Zumba',
        'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'poster' => "https://cdn.pixabay.com/photo/2017/06/08/01/47/zumba-2382200_960_720.jpg"
        ],
        ['name' => 'Danse Bollywood',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'poster' => "https://images.pexels.com/photos/8752654/pexels-photo-8752654.jpeg"
        ],
        ['name' => 'Danse africaine',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'poster' => "https://cdn.pixabay.com/photo/2018/12/18/17/03/dance-3882695_960_720.jpg"
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CLASSES as $danceClasses) {
            $classes = new DanceClasses();
            $classes->setName($danceClasses['name']);
            $classes->setDescription($danceClasses['description']);
            $classes->setPoster($danceClasses['poster']);

            $this->addReference('dance_classes_' . $danceClasses['name'], $classes);
            
            $manager->persist($classes);
        }
        $manager->flush();
    }
}
