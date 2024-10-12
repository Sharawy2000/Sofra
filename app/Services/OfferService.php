<?php 
namespace App\Services;

use App\Repositories\Interface\OfferRepositoryInterface;
use App\Traits\Helper;

class OfferService extends BaseService
{
    use Helper;
    protected $offerRepository;

    public function __construct(OfferRepositoryInterface $offerRepository){
        parent::__construct($offerRepository);
        $this->offerRepository=$offerRepository;
    }

    public function restaurant(){
        $restaurant=auth()->guard('restaurant')->user();
        
        if(!$restaurant){
            abort(401, 'لا يوجد بيانات');
        }
        return $restaurant;
    }
    public function allValidOffers(){

        return $this->offerRepository->validOffers();

    }

    public function placeOffer($request,$isApi=true){
        
        $restaurant=$this->restaurant();

        $request->merge(['restaurant_id' => $restaurant->id]);
        
        $offer=$this->offerRepository->store($request->all());

        if($request->hasFile('image')){
            $this->UploadImage($request,'image',$offer,'offers/images');
        }

        return $offer;

    }
    public function updateOffer($request, $id){

        $this->restaurant();

        $offer=$this->offerRepository->update($request->except('image'),$id);

        if($request->has('image')){
            $this->UploadImage($request,'image',$offer,'offers/images');
        }

        return $offer;

    }

    public function getfilterOffers($request){
        if($request->search != null){

            return $this->offerRepository->filter($request->search);
            
        }else{

            return $this->all();
        }
    }

}