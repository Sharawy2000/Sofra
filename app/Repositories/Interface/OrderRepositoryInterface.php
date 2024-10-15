<?php 
namespace App\Repositories\Interface;

interface OrderRepositoryInterface
{
    public function orders($model);
    public function newOrders($model);
    public function previousOrders($model);
    public function currentOrders($model);
    public function orderStatus($status,$order);
    public function attachProducts($order,$product,$quantity);
    public function filter($search);


}