<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $restaurantService;

    public function __construct(RestaurantService $restaurantService){
        $this->restaurantService = $restaurantService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $restaurants=$this->restaurantService->getFiltered($request->search);

        return view('dashboard.restaurants.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $restaurant = $this->restaurantService->get($id);

        return view('dashboard.restaurants.show',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $restaurant = $this->restaurantService->get($id);

        return view('dashboard.restaurants.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'is_activated'=>'required|integer'
        ]);

        $this->restaurantService->deAcivate($request,$id);
        $this->restaurantService->update($request,$id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
