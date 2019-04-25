<?php

namespace Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public $idtotest;

    public function testGetUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/api/user');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostAddUser()
    {
        
        $data = '{
                "name": "unittesting",
                "email": "phpunit@testing.api",
                "birthday": "'.date('Y-m-d').'",
                "gender": "male"}';

        $client = static::createClient();
        $client->request('PUT', '/api/adduser', [], [],
            ['CONTENT_TYPE' => 'application/json'],
            $data);

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    /**
     * @depends testPostAddUser
     */
    public function testGetOneUser()
    {
        $client = static::createClient();
        $client->request('GET', '/api/user/unittesting');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        return json_decode($client->getResponse()->getContent())[0]->id;
    }

    
    /**
     * @depends testGetOneUser
     */
    public function testPostUpdateUser()
    {

        $client = static::createClient();
        $client->request('PUT', 'http://127.0.0.1:8000/api/updateuser/' . func_get_args()[0], 
            [
                "name"     => "unittesting2",
                "email"    => "phpunit2@testing2.api",
                "birthday" => strval(date('Y-m-d')),
                "gender"   => "female"
            ]);

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    /**
     * @depends testGetOneUser
     */
    public function testPostDeleteUser()
    {
        $client = static::createClient();
        $client->request('DELETE', 'http://127.0.0.1:8000/api/deleteuser/' . func_get_args()[0]);

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    /**/

}