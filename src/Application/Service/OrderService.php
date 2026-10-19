<?php

namespace DifferDev;

final class OrderService
{
    public function __construct(
        private OrderRepository $repository
    ) {}

    public function create(array $items): Order
    {
        if (empty($items)) {
            throw new InvalidArgumentException(
                'Order must have items'
            );
        }

        $order = new Order($items);

        if ($order->total() > 500) {
            $order->applyDiscount(0.10);
        }

        $this->repository->save($order);

        return $order;
    }
}