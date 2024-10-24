<?php
namespace App\Repositories\Interface;

interface ClientRepositoryInterface
{
    public function validateLogin($data);
    public function createToken($client);
    public function removeToken($client);
    public function removeAllTokens($id);
    public function filter($search);
    public function validateResetCode($data);

}
