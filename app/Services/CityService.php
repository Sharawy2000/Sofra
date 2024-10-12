<?php 
namespace App\Services;

use App\Repositories\Interface\CityRepositoryInterface;

class CityService extends BaseService
{
    public function __construct(CityRepositoryInterface $cityRepository){
        parent::__construct($cityRepository);
    }
}