<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class HomeControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testShowAllPosts()
    {
        $client = static::createClient();
        $client->request('GET', '/reseaus');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
