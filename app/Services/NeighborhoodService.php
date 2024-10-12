<?php 
namespace App\Services;

use App\Repositories\Interface\NeighborhoodRepositoryInterface;

class NeighborhoodService extends BaseService
{
    public function __construct(NeighborhoodRepositoryInterface $neighborhoodRepository){
        parent::__construct($neighborhoodRepository);
    }
}