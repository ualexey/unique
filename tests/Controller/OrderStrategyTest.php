<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderStrategyTest extends WebTestCase
{

    public function testSuccessExecute()
    {
        $orderNumber = 1;

        $client = static::createClient();
        $client->request('GET', '/order/' . $orderNumber);

        $response = $client->getResponse()->getContent();

        $data = json_decode($response, true);

//        $this->assertEquals(1, $data[$orderNumber]);

        $this->assertArrayHasKey('currency', $data[$orderNumber]);
        $this->assertArrayHasKey('date', $data[$orderNumber]);
        $this->assertArrayHasKey('total', $data[$orderNumber]);

        if (isset($data[$orderNumber]['product'])) {
            $this->assertArrayHasKey('title', $data[$orderNumber]['product']);
            $this->assertArrayHasKey('price', $data[$orderNumber]['product']);
        }
    }

    public function testFailExecute()
    {
        $orderNumber = 'ghjvkyfvk7giydftyjf6';

        $client = static::createClient();
        $client->request('GET', '/order/' . $orderNumber);

        $response = $client->getResponse()->getContent();

        $data = json_decode($response, true);

        $this->assertArrayHasKey('error', $data);
        $this->assertEquals('Order not found', $data['error']);
    }


}
