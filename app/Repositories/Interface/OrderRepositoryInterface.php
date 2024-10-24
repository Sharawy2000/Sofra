<?php
namespace App\Repositories\Interface;

interface OrderRepositoryInterface
{
    public function orderStatus($status,$order);
    public function filter($search);
    public function getOrders($model, $status = null);

}
