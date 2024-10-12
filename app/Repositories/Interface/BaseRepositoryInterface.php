<?php 
namespace App\Repositories\Interface;

interface BaseRepositoryInterface
{
    // public function validateLogin($data);
    // public function createToken($id);
    // public function currentToken($id);
    // public function removeToken($id);

    // public function myOrders($model);
    // public function myNotifications($model);
    // public function newOrders($model);
    // public function previousOrders($model);
    
    public function getAll();
    public function store($data);
    public function find($id);
    public function update($data,$id);
    public function remove($id);

    // public function orderStatus($status,$order);
    // public function getFcmToken($module);
    // public function addFcmToken($data,$module);




    
}