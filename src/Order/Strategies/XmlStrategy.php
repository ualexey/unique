<?php

namespace App\Order\Strategies;

use App\Order\Interfaces\OrderStrategyInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class XmlStrategy implements OrderStrategyInterface
{

    private $ordersFileName = 'Orders.xml';
    private $orderData = [];

    /**
     * @param string $id
     * @return array
     */
    public function getOrderData(string $id): array
    {

        $orderFile = file_get_contents(dirname(__DIR__, 2) . '\Order\XmlData\\' . $this->ordersFileName);

        $xml = simplexml_load_string($orderFile);

        if (!isset($xml->order)) {
            throw new Exception("Invalid xml structure");
        }

        foreach ($xml->order as $order) {

            if ((string)$order->id != $id) {
                continue;
            }

            $this->orderData[(string)$order->id] = [
                'currency' => $order->currency ? (string)$order->currency : null,
                'date' => $order->date ? (string)$order->date : null,
                'total' => $order->total ? (float)$order->total : null,
            ];

            if ($order->products) {
                foreach ($order->products as $product) {
                    foreach ($product as $item) {
                        $this->orderData[(string)$order->id]['product'] = [
                            'title' => $item->attributes()->title ? (string)$item->attributes()->title : null,
                            'price' => $item->attributes()->price ? (float)$item->attributes()->price : null,
                        ];
                    }
                }
            }
        }

        return $this->orderData;
    }


}
