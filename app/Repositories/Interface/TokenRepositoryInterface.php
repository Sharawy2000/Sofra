<?php 
namespace App\Repositories\Interface;

interface TokenRepositoryInterface
{
    public function add($data,$module);
    public function get($module);
}