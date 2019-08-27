<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Post;
use App\Entity\Category;
use App\Entity\Comment;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // Création de catégories fake
        for ($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setDescription($faker->paragraph());
        
            $manager->persist($category);

            // Création de faux Post
        

            for ($j = 1; $j <= 7; $j++) {
                $post = new Post();

                $content = '<p>' . join($faker->paragraphs(5), '</p></p>') . '</p>';
            

                $post->setContent($content)
                ->setCreatedAt($faker->dateTimeBetween('-3 months'))
                ->setCategory($category);

                $manager->persist($post);

                // Ajout de commentaires

                for ($k = 1; $k <= mt_rand(4, 10); $k++) {
                    $comment = new Comment();
                    $content = '<p>' . join($faker->paragraphs(1), '</p></p>') . '</p>';
                    $comment->setAuthor($faker->name)
                        ->setContent($content)
                        ->setCreatedAt($faker->dateTimeBetween('-1 months'))
                        ->setPost($post);
                        
                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }
}
