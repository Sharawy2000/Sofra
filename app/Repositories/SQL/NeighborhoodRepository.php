<?php 
namespace App\Repositories\SQL;

use App\Models\Neighborhood;
use App\Repositories\Interface\NeighborhoodRepositoryInterface;

class NeighborhoodRepository extends BaseRepository implements NeighborhoodRepositoryInterface{
    protected $neighborhood;

    public function __construct(Neighborhood $neighborhood){
        parent::__construct($neighborhood);
    }

}