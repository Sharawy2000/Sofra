<?php
namespace App\Repositories\Interface;

interface OfferRepositoryInterface
{
//    public function getOffers($valid=false);

    public function all($model);
    public function validOffers();
    public function filter($search);


}
