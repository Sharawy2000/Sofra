<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OfferService;
use App\Traits\Helper;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use Helper;
    protected $offerService;
    public function __construct(OfferService $offerService){
        $this->offerService = $offerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = $this->offerService->allValidOffers();

        return $this->responseJson('جديد العروض',$offers);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'image'=>'required|file|mimes:png,jpg,jpeg,gif,svg,ico',
            'date_begin'=>'required',
            'date_end'=>'required',
            'discount'=>'required',
       ]);

       $offer = $this->offerService->placeOffer($request);

       return $this->responseJson('تم انشاء العرض',$offer);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer=$this->offerService->get($id);

        return $this->responseJson('العرض',$offer);
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'nullable|string',
            'description'=>'nullable|string',
            'image'=>'nullable|file|mimes:png,jpg,jpeg,gif,svg,ico',
            'date_begin'=>'nullable',
            'date_end'=>'nullable',
            'discount'=>'nullable',
       ]);


       $offer = $this->offerService->updateOffer($request,$id);

       return $this->responseJson('تم تحديث العرض',$offer);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->offerService->delete($id);

        return $this->responseJson('تم حذف العرض');

    }
}
