<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService){
        $this->cityService = $cityService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = $this->cityService->all();
        return view('dashboard.cities.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.cities.create',);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string'
        ]);

        $this->cityService->store($request);
        return back()->with('success','تم إنشاء المدينة');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city=$this->cityService->get($id);
        return view('dashboard.cities.show',get_defined_vars());

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city=$this->cityService->get($id);
        return view('dashboard.cities.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'nullable|string'
        ]);

        $this->cityService->update($request, $id);

        return back()->with('success','تم تحديث المدينة');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cityService->delete($id);

        return back()->with('success','تم حذف المدينة');

    }
}
