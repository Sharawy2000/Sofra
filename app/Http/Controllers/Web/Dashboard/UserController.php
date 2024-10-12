<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=$this->userService->all();

        return view('dashboard.users.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed',
            'role_list'=>'required|array',
        ]);

        $user = $this->userService->store($request);
        $this->userService->attachRoles($request,$user);

        return back()->with('success','تم إنشاء المستخدم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=$this->userService->get($id);

        return view('dashboard.users.show',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->userService->get($id);

        return view('dashboard.users.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,'.$id,
            'role_list'=>'nullable|array'
        ]);

        $user = $this->userService->update($request,$id);
        $this->userService->syncRoles($request,$user);


        return back()->with('success','تم تحديث المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userService->delete($id);

        return back()->with('success','تم حذف المستخدم بنجاح');

    }
}
