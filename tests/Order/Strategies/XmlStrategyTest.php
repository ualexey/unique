<?php

namespace App\Tests\Order\Strategies;

use App\Order\OrderManager;
use App\Order\Strategies\XmlStrategy;
use PHPUnit\Framework\TestCase;

class XmlStrategyTest extends TestCase
{

    /** @test */
    public function xlmStrategyInstanceTest()
    {
        $xmlStrategy = new XmlStrategy();

        $this->assertInstanceOf(XmlStrategy::class, $xmlStrategy);
    }

    /** @test */
    public function xlmStrategyTest()
    {
        $id = 1;

        $obj = new OrderManager(new XmlStrategy());
        $result = $obj->executeStrategy($id);

        $this->assertArrayHasKey('id', $result[$id]);
    }


}
