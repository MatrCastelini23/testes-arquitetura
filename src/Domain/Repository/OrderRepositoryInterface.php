<?php

namespace DifferDev\Domain\Repository;

use DifferDev\Domain\Entity\Order;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;

    public function findById(string $id): Order;
}