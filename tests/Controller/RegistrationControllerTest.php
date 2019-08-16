<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class RegistrationControllerTest extends WebTestCase
{
    public function testHomepage()
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
