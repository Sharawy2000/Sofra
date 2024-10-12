<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\NeighborhoodService;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    protected $neighborhoodService;

    public function __construct(NeighborhoodService $neighborhoodService){
        $this->neighborhoodService = $neighborhoodService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $neighborhoods = $this->neighborhoodService->all();
        return view('dashboard.neighborhoods.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.neighborhoods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'city_id'=>'required|integer|exists:cities,id',
        ]);

        $this->neighborhoodService->store($request);

        return back()->with('success','تم إنشاء الحي بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $neighborhood=$this->neighborhoodService->get($id);

        return view('dashboard.neighborhoods.show',get_defined_vars());
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $neighborhood=$this->neighborhoodService->get($id);
        
        return view('dashboard.neighborhoods.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'nullable|string',
            'city_id'=>'nullable|integer|exists:cities,id',
        ]);

        $this->neighborhoodService->update($request, $id);

        return back()->with('success','تم تحديث الحي بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->neighborhoodService->delete($id);
        
        return back()->with('success','تم حذف الحي بنجاح');

    }
}
