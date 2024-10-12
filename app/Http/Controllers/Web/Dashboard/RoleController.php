<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService){
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=$this->roleService->all();

        return view('dashboard.roles.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string'
        ]);

        $role = $this->roleService->store($request);

        $this->roleService->attachPermissions($request, $role);


        return back()->with('success','تم إنشاء الرتبة');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role=$this->roleService->get($id);

        return view('dashboard.roles.show',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=$this->roleService->get($id);

        return view('dashboard.roles.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'nullable|string',
            'permission_list'=>'nullable|array'
        ]);
        
        $role=$this->roleService->update($request,$id);
        $this->roleService->syncPermissions($request,$role);

        return back()->with('success','تم تحديث الرتبة');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roleService->delete($id);
    }
}
