<?php

namespace DifferDev\Application\Service;

use DifferDev\Domain\Entity\Order;
use DifferDev\Domain\Repository\OrderRepositoryInterface;
use Exception;

final readonly class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {
    }

    public function create(array $items): Order
    {
        if (empty($items)) {
            throw new Exception(
                'Order must have items'
            );
        }

        $order = new Order($items);

        if ($order->total() > 500) {
            $order->applyDiscount(0.10);
        }

        $this->orderRepository->save($order);

        return $order;
    }
}