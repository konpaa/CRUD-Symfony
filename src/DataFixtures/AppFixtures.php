<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Article;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{
    private PasswordHasherFactoryInterface $encoderFactory;

    /**
     * AppFixtures constructor.
     * @param PasswordHasherFactoryInterface $encoderFactory
     */
    public function __construct(PasswordHasherFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Pasha');
        $user->setEmail('example@google.com');
        $user->setPassword('password');
        $manager->persist($user);

        $secondUser = new User();
        $secondUser->setName('Vova');
        $secondUser->setEmail('vova@google.com');
        $secondUser->setPassword('password123');
        $manager->persist($secondUser);

        $firstArticle = new Article();
        $firstArticle->setName('First');
        $firstArticle->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $firstArticle->setCreator($user);
        $firstArticle->setCreatedAt(new DateTime());
        $manager->persist($firstArticle);

        $secondArticle = new Article();
        $secondArticle->setName('Second');
        $secondArticle->setBody('vulputate ut pharetra sit amet aliquam');
        $secondArticle->setCreator($secondUser);
        $secondArticle->setCreatedAt(new DateTime());
        $manager->persist($secondArticle);

        $thirdArticle = new Article();
        $thirdArticle->setName('Third');
        $thirdArticle->setBody('eget magna fermentum iaculis eu non diam phasellus');
        $thirdArticle->setCreator($secondUser);
        $thirdArticle->setCreatedAt(new DateTime());
        $firstArticle->setUpdatedAt(new DateTime());
        $manager->persist($thirdArticle);

        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('admin@example.com');
        $admin->setPassword($this->encoderFactory->getPasswordHasher(Admin::class)->hash('admin'));
        $manager->persist($admin);

        $manager->flush();
    }
}
