<?php

namespace App\DataFixtures;

use App\Entity\Rights;
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
        $droit_ad = new Rights();
        $droit_ad->setRoleName('administrateur');
        $manager->persist($droit_ad);

        $droit_ouv = new Rights();
        $droit_ouv->setRoleName('ouvrier');
        $manager->persist($droit_ouv);

        $droit_resp = new Rights();
        $droit_resp->setRoleName('responsable atelier');
        $manager->persist($droit_resp);

        $droit_comm = new Rights();
        $droit_comm->setRoleName('commercial');
        $manager->persist($droit_comm);


        $usersData = [
            [
                'email' => 'user1@example.com',
                'roles' => ['ROLE_USER'],
                'password' => 'password123',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'right' => $droit_ouv,
            ],
            [
                'email' => 'admin@example.com',
                'roles' => ['ROLE_ADMIN'],
                'password' => 'admin123',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'right' => $droit_ad,
            ],
            [
                'email' => 'responsable@example.com',
                'roles' => ['ROLE_USER'],
                'password' => 'password123',
                'first_name' => 'Resp',
                'last_name' => 'Atelier',
                'right' => $droit_resp,
            ],
            [
                'email' => 'commercial@example.com',
                'roles' => ['ROLE_TRADER'],
                'password' => 'password123',
                'first_name' => 'Commercial',
                'last_name' => 'Man',
                'right' => $droit_comm,
            ],
        ];



        foreach ($usersData as $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $user->setFirstName($userData['first_name']);
            $user->setLastName($userData['last_name']);
            $user->setRights($userData['right']);

            $encodedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($encodedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
