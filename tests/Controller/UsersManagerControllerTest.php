<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class UsersManagerControllerTest extends WebTestCase
{
    public function testShowUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testShowAllPosts()
    {
        $client = static::createClient();
        $client->request('GET', '/reseaus');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
