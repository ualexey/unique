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

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('currency', $data);
        $this->assertArrayHasKey('date', $data);
        $this->assertArrayHasKey('total', $data);

        if (isset($data['product'])) {
            $this->assertArrayHasKey('title', $data['product']);
            $this->assertArrayHasKey('price', $data['product']);
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
