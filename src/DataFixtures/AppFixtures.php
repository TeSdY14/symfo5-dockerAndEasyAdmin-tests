<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Comment;
use App\Entity\Conference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AppFixtures extends Fixture
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager)
    {
        // Deux nouvelles conférences
        $bruxelles = new Conference();
        $bruxelles->setCity('Bruxelles');
        $bruxelles->setYear('2021');
        $bruxelles->setIsInternational(true);
        $bruxelles->setSlug('bruxelles-2021');
        $manager->persist($bruxelles);

        $caen = new Conference();
        $caen->setCity('Caen');
        $caen->setYear('2021');
        $caen->setIsInternational(false);
        $caen->setSlug('caen-2021');
        $manager->persist($caen);

        // nouveau commentaire
        $comment = new Comment();
        $comment->setConference($bruxelles);
        $comment->setAuthor('TeSdY');
        $comment->setEmail('TeSdY14@toto.com');
        $comment->setText("Bonjour je suis un commentaire né d'une fixture !");
        $manager->persist($comment);

        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setPassword($this->encoderFactory->getEncoder(Admin::class)->encodePassword('admin', null));
        $manager->persist($admin);

        $manager->flush();
    }
}
