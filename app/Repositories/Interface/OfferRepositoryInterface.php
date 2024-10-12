<?php 
namespace App\Repositories\Interface;

interface OfferRepositoryInterface
{
    public function all($model);
    public function validOffers();
    public function filter($search);


}