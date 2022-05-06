<?php

namespace App\Order\Interfaces;

interface  OrderStrategyInterface
{
    /**
     * @param string $id
     * @return array
     */
    public function getOrderData(string $id): array;

}
