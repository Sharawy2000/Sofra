<?php
namespace App\Repositories\Interface;

interface RestaurantRepositoryInterface
{
    public function validateLogin($data);
    public function createToken($restaurant);
    public function removeToken($restaurant);
    public function overallRateCalc($restaurant);
    public function myComissionsCalc($restaurant);
    public function removeAllTokens($id);
    public function filter($search);
    public function validateResetCode($data);


}
