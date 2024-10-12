<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $CategoryService;

    public function __construct(CategoryService $CategoryService){
        $this->CategoryService = $CategoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = $this->CategoryService->all();
        return view('dashboard.categories.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create',);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string'
        ]);

        $this->CategoryService->store($request);
        return back()->with('success','تم إنشاء التصنيف');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cat=$this->CategoryService->get($id);
        return view('dashboard.categories.show',get_defined_vars());

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cat=$this->CategoryService->get($id);
        return view('dashboard.categories.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'nullable|string'
        ]);

        $this->CategoryService->update($request, $id);

        return back()->with('success','تم تحديث التصنيف');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->CategoryService->delete($id);

        return back()->with('success','تم حذف التصنيف');

    }
}
