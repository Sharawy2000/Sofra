<?php 
namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function validateLogin($data);
    public function attach($user,$role_list);
    public function sync($user,$role_list);


}