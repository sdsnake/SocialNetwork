<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class PostControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();
        $client->request('GET', '/post/77');

        $this->assertSame(302, $client->getResponse()->getStatusCode()); //test de la redirection
    }

    public function testEditPost()
    {
        $client = static::createClient();
        $client->request('GET', '/reseaus');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testCreatePost()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'new');


        $form = $crawler->selectButton('Ajouter')->form();
        $form['post[category]'] = 'Informatique';
        $form['post[content]'] = 'Symfony rocks!';
        $form['post[img]'] = 'http://capside-formation.fr/wp-content/uploads/2014/05/Symfony-boule-150x150.png';
        $form['post[tags]'] = 'Symfony';
        $client->submit($form);

        // submit the Form object

        $crawler = $client->followRedirect();
    }
}
