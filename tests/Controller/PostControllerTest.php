<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class PostControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $client->request('GET', '/post/76/show');

        $this->assertSame(301, $client->getResponse()->getStatusCode()); //test de la redirection
    }

    public function testEdit()
    {
        $client = static::createClient();
        $client->request('GET', 'post/76/edit');

        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }

    public function testCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/create');
        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/97/show');
        $this->assertSame(301, $client->getResponse()->getStatusCode());
    }
}
