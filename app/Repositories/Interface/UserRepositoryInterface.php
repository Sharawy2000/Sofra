<?php 
namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function validateLogin($data);
    
}