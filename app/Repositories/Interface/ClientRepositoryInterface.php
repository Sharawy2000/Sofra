<?php
namespace App\Repositories\Interface;

interface ClientRepositoryInterface
{
    public function addReview($data,$client);
    public function validateLogin($data);
    public function createToken($client);
    public function currentToken($client);
    public function removeToken($id);
    public function removeAllTokens($id);
    public function filter($search);

    // public function getFcmToken($module);
    // public function addFcmToken($data,$module);
    // public function pushNotification($data,$module);

    // public function saveOrder($data,$client);
}