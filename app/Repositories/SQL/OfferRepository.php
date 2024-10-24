<?php
namespace App\Repositories\SQL;

use App\Models\Offer;
use App\Repositories\Interface\OfferRepositoryInterface;
use Carbon\Carbon;

class OfferRepository extends BaseRepository implements OfferRepositoryInterface{
    protected $offer;

    public function __construct(Offer $offer){
        parent::__construct($offer);
        $this->offer = $offer;
    }

    public function validOffers(){
        return $this->offer->where('date_begin', '<=', Carbon::now())
        ->where('date_end', '>=', Carbon::now())
        ->latest()
        ->paginate(5);
    }
    public function all($model){
        return $model->offers()->latest()->paginate(5);
    }

    public function filter($search){
        return $this->offer->whereHas('restaurant',function($query) use($search){
            $query->where('name','like','%'.$search.'%');
        })
        ->orWhere('name','like','%' . $search . '%')
        ->orWhere('date_begin',$search)
        ->orWhere('date_end',$search)
        ->latest()
        ->paginate(5);

    }

}
