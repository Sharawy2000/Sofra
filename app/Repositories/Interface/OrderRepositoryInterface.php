<?php 
namespace App\Repositories\Interface;

interface OrderRepositoryInterface
{
    // public function store($data,$restaurant_id);
    // public function find($id);
    // public function update($data,$id);
    // public function remove($id);
    // public function getAll();

    public function orders($model);
    // public function myNotifications($model);
    public function newOrders($model);
    public function previousOrders($model);
    public function currentOrders($model);
    public function orderStatus($status,$order);
    public function attachProducts($order,$product,$quantity);
    public function filter($search);


}