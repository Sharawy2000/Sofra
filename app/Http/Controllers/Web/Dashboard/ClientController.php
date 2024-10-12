<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService){
        $this->clientService = $clientService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients= $this->clientService->getFiltered($request->search);

        return view('dashboard.clients.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.clients.create');
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
        $client = $this->clientService->get($id);
        return view('dashboard.clients.show',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'is_activated'=>'required|integer'
        ]);

        $this->clientService->deAcivate($request,$id);
        $this->clientService->update($request,$id);

        return back();
        // return back()->with('success','تم تحديث التفعيل للعميل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->clientService->delete($id);

        return back()->with('success','تم حذف العميل بنجاح');
    }
}
