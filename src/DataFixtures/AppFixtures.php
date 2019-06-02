<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Post;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1 ; $i <= 10;$i++){

            $post = new Post(); 
            $post->setTitle("Titre du Post n $i")
                   ->setContent("<p> Contenue du post n $i</p>")
                   ->setImage("http://placehold.it/350x150")
                   ->setCreatedAt(new \DateTime());
            
            $manager->persist($post);

        }       

        $manager->flush();
    }
}
