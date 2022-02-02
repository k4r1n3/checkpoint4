<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User;
        $admin->setFirstname('Karine');
        $admin->setEmail('k.challier@yahoo.fr');
        $admin->addRole('ROLE_ADMIN');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'aaaaaa'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);
        $manager->flush();
    }
}
