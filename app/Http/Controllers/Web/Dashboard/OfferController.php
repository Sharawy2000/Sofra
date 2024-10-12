<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    protected $offerService;

    public function __construct(OfferService $offerService){
        $this->offerService = $offerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $offers=$this->offerService->getfilterOffers($request);

        return view('dashboard.offers.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashboard.offers.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->offerService->delete($id);

        return back()->with('success','تم حذف العرض');
    }
}
