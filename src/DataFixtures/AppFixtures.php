<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Room;
use App\Entity\Option;
use App\Entity\TypeOption;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // On instancie Faker pour générer des données aléatoires en français
        $faker = Factory::create($fakerLocale = 'fr_FR');
        
        // On crée un tableau contenant les noms des options
        $typeOptions = ['Software', 'Hardware', 'Ergonomie'];

        // On crée un tableau vide qui contiendra tous les objets TypeOption créés ici
        $objectTypeOptions = [];

        // On boucle sur chaque élément du tableau $typeOptions
        // pour créer un objet TypeOption et l'ajouter au tableau $objectTypeOptions
        // puis on persiste chaque objet TypeOption
        foreach ($typeOptions as $item) {
            $typeOption = new TypeOption();
            $typeOption->setName($item);
            $objectTypeOptions[] = $typeOption;
            $manager->persist($typeOption);
        }

        // On crée un tableau vide qui contiendra tous les objets Option créés ici
        $objectOptions = [];

        // On boucle sur 30 éléments pour créer 30 objets Option
        // et les ajouter au tableau $objectOptions
        // puis on persiste chaque objet Option
        for ($i=0; $i < 30; $i++) { 
            $option = new Option();
            $option->setType($objectTypeOptions[$faker->numberBetween(0, count($objectTypeOptions) - 1)]);
            $option->setName($faker->word());
            $option->setDescription($faker->sentence());
            $objectOptions[] = $option;
            $manager->persist($option);
        }

        // On crée un tableau vide qui contiendra tous les objets Room créés ici   
        $objectRooms = [];


        // On boucle sur 10 éléments pour créer 10 objets Room
        // et les ajouter au tableau $objectRooms
        // puis on persiste chaque objet Room
        for ($i=0; $i < 20; $i++) { 
            $room = new Room();
            $room->setName($faker->word());
            $room->setAddress($faker->address());
            $room->setCapacity($faker->numberBetween(1, 100));
            $room->setDayPrice($faker->randomFloat(2, 50, 500));
            $room->setIsRentable($faker->boolean());
            // On génère un nombre aléatoire entre 1 et 5
            // qui déterminera le nombre d'options à ajouter à la salle
            $max = rand(1, 5);
            // On crée un tableau vide qui contiendra les index des options à ajouter
            $k = [];
            // On boucle sur $max éléments pour ajouter $max options à la salle
            for ($j=0; $j < $max; $j++) { 
                $nb = $faker->numberBetween(0, count($objectOptions) - 1);
                // Si l'index $nb n'est pas déjà présent dans le tableau $k
                if (!in_array($nb, $k)) {
                    // On ajoute l'index $nb au tableau $k
                    $k[] = $nb;
                    // On ajoute l'option correspondant à l'index $nb à la salle
                    $room->addOption($objectOptions[$nb]);
                }
            }
            // On ajoute la salle au tableau $objectRooms
            $objectRooms[] = $room;
            // On persiste la salle
            $manager->persist($room);
        }

        


        $manager->flush();
    }
}
