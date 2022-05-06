<?php

namespace App\Controller;

use App\Order\OrderManager;
use App\Order\Strategies\XmlStrategy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OrderController extends AbstractController
{

    /**
     * @Route("/order/{id}/{type?xml}", name="getOrderById", methods={"GET"}))
     */
    public function getOrderById($type, $id): Response
    {

        switch ($type) {
            case 'db':
                // In order to access and manipulate data from different system

                throw new Exception("DB strategy not defined");

                break;
            default:
                $manager = (new OrderManager(new XmlStrategy()));
        }

        $result = $manager->executeStrategy($id);

        if (!$result) {
            throw new Exception("Order not found");
        }

        $response = new Response();
        $response->setCharset('UTF-8');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($result));
        return $response;
    }
}
