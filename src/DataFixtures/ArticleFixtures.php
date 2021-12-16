<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for($use = 1; $use <= 10; $use++)
        {
            $user = new User;

            $user->setEmail($faker->freeEmail)
                    ->setPassword($faker->password)
                    ->setPseudo($faker->userName)
                    ->setNom($faker->lastName)
                    ->setPrenom($faker->firstName)
                    ->setSexe($faker->word)
                    ->setTelephone($faker->randomNumber($nbDigits = 9, $strict = true))
                    ->setAdresse($faker->streetAddress)
                    ->setVille($faker->city)
                    ->setCodePostal($faker->randomNumber($nbDigits = 5, $strict = true));
                $manager->persist($user);
        }

        for($cat = 1; $cat <= 10; $cat++)
        {
            $category = new Category;

            $category->setTitre($faker->word)
                     ->setGrdCat($faker->word);

            $manager->persist($category);

            for($art = 1; $art <= mt_rand(3,4); $art++)
            {
                $article = new Article;

                // join() : fonction predefinie de PHP (alias : de implode) mais pour les chaine de caractères
                // $contenu = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

                $article->setTitre($faker->sentence())
                        ->setDescription($faker->text($maxNbChars = 255))
                        ->setPhoto($faker->imageUrl($width = 640, $height = 480))
                        ->setPrix($faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 250))
                        ->setStock($faker->randomFloat($nbMaxDecimals = 0, $min = 0, $max = 100))
                        ->setCouleur($faker->safeColorName)
                        ->setCategory($category);// on relit les article aux categorie déclarées ci-dessus, le setteur attend en arguments l'objet entité $category pour créer la clé etrangèreet non un int               
                    $manager->persist($article);
            }
        }

        $manager->flush();
    }
    
}