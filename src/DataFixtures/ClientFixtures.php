<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class ClientFixtures extends Fixture
{

    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $client1 = new Client();
  
        $client1->setEmail('admin@admin.fr')
        ->setPassword($this->userPasswordHasherInterface->hashPassword(
            $client1, "admin"
        ))
        ->setRoles(['ROLE_ADMIN'])
        ->setNom($faker->firstName())
        ->setPrenom($faker->lastName())
        ->setAge($faker->numberBetween(18,99))
        ->setAdresse($faker->address())
        ->setTelephone($faker->phoneNumber());
        $manager->persist($client1);

        $client2 = new Client();

        $client2->setEmail('user@user.fr')
        ->setPassword($this->userPasswordHasherInterface->hashPassword(
            $client2, "user"
        ))
        ->setRoles(['ROLE_USER'])
        ->setNom($faker->firstName())
        ->setPrenom($faker->lastName())
        ->setAge($faker->numberBetween(18,99))
        ->setAdresse($faker->address())
        ->setTelephone($faker->phoneNumber());
        $manager->persist($client2);

        $manager->flush();
    }
}
