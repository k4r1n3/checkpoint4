<?php

namespace App\DataFixtures;

use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tags = [
            'All',
            'HTML',
            'Bootstrap',
            'CSS',
            'PHP',
            'Symfony',
        ];
        foreach ($tags as $value) {
            $tag = new Tags();
            $tag->setName($value);
            $manager->persist($tag);
        }
        $manager->flush();
    }
}
