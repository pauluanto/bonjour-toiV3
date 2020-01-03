<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $marque1 = new Marque();
        $marque1->setLibelle("Yotota");
        $manager->persist($marque1);
        $marque2 = new Marque();
        $marque2->setLibelle("Jeupo");
        $manager->persist($marque2);

        $modele1 = new Modele();
        $modele1->setLibelle("Rayis")
            ->setImage("modele1.jpg")
            ->setMarque($marque1);
        $manager->persist($modele1);
        $modele2 = new Modele();
        $modele2->setLibelle("Yraus")
            ->setImage("modele2.jpg")
            ->setMarque($marque1);
        $manager->persist($modele2);
        $modele3 = new Modele();
        $modele3->setLibelle("007")
            ->setImage("modele3.jpg")
            ->setMarque($marque1);
        $manager->persist($modele3);
        $modele4 = new Modele();
        $modele4->setLibelle("008")
            ->setImage("modele4.jpg")
            ->setMarque($marque1);
        $manager->persist($modele4);
        $modele5 = new Modele();
        $modele5->setLibelle("009")
            ->setImage("modele5.jpg")
            ->setMarque($marque1);
        $manager->persist($modele5);

        $modeles = [$modele1,$modele2,$modele3,$modele4,$modele5];

        $faker = \Faker\Factory::create('fr_FR');
        foreach($modeles as $m){
            $rand = rand(3,5);
            for($i=1; $i <= $rand; $i++){
                $voiture = new Voiture();
                //XX1234XX
                $voiture->setPseudo($faker->regexify("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                    ->setTaille($faker->randomElement($array = array(3,5)))
                    ->setAnnedenaissance($faker->numberBetween($min=1990,$max=2019))
                    ->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2))
                    ->setCitation($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setCouleurCheveux($faker->colorName)
                    ->setCouleurYeux($faker->colorName)
                    ->setSexe($faker->text($maxNbChars = 20, $indexSize = 1))
                    ->setVille($faker->city)
                    ->setFilms($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setLangueParle($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setLoisirs($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setLivres($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setModele($m);
                $manager->persist($voiture);
            }
        }


        $manager->flush();
    }
}
