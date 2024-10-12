<?php 
namespace App\Repositories\Interface;

interface NotificationRepositoryInterface
{
    public function all($model);
    public function add($data,$model);

}