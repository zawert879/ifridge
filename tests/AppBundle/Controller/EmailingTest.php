<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 22.11.2017
 * Time: 14:17
 */

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmailingTest extends WebTestCase{
    public function testSendMessage(){
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/sendmessage',
            array("name"=>"Fabien","setto"=>"zawert879@yandex.ru","message"=>"hello"),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name":"Fabien","setto":"zawert879@yandex.ru","message":"hello"}'
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}