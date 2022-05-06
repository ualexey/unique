<?php

namespace App\Order;

use App\Order\Interfaces\OrderStrategyInterface;

/**
 * Realiastion of Strategy Pattern
 */
class OrderManager
{

    private $strategy;

    /**
     * @param OrderStrategyInterface $strategy
     */
    public function __construct(OrderStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param string $id
     * @return array
     */
    public function executeStrategy(string $id): array
    {
        return $this->strategy->getOrderData($id);
    }

}
