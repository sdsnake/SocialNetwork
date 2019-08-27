<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testShowUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }

    public function testSuspend()
    {
        $client = static::createClient();
        $client->request('GET', '/20/switch');

        $this->assertSame(301, $client->getResponse()->getStatusCode());
    }
}
