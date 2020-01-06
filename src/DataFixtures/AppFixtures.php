<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {



        $faker = \Faker\Factory::create('fr_FR');

            for($i=1; $i <= 50; $i++){
                $voiture = new Voiture();

                $voiture->setPseudo($faker->name("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                    ->setTaille($faker->randomElement($array = array(140,200)))
                    ->setAnnedenaissance($faker->numberBetween($min=1900,$max=2002))
                    ->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2))
                    ->setCitation($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setCouleurCheveux($faker->colorName)
                    ->setCouleurYeux($faker->colorName)
                    ->setJerecherche($faker->text($maxNbChars = 20, $indexSize = 1))
                    ->setVille($faker->city)
                    ->setFilms($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setLangueParle($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setLoisirs($faker->text($maxNbChars = 20, $indexSize = 5))
                    ->setLivres($faker->text($maxNbChars = 20, $indexSize = 5));

                $manager->persist($voiture);
            }

        $manager->flush();
    }
}
