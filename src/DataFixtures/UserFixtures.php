<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $usersData = [
            [
                'email' => 'user1@example.com',
                'roles' => ['ROLE_USER'],
                'password' => 'password123',
                'first_name' => 'John',
                'last_name' => 'Doe',
            ],
            [
                'email' => 'admin@example.com',
                'roles' => ['ROLE_ADMIN'],
                'password' => 'admin123',
                'first_name' => 'Admin',
                'last_name' => 'User',
            ],
            // Add more users as needed
        ];

        foreach ($usersData as $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $user->setFirstName($userData['first_name']);
            $user->setLastName($userData['last_name']);

            // Encode the password (assuming the User entity implements UserInterface)
            $encodedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($encodedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
