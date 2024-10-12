<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService){
        $this->settingService = $settingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $setting = $this->settingService->get(1);

        // return view('dashboard.settings.edit',get_defined_vars());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting=$this->settingService->get($id);

        return view('dashboard.settings.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'about_app'=>'nullable|string',
            'android_link'=>'nullable|string',
            'ios_link'=>'nullable|string',
            'order_text'=>'nullable|string',
            'offer_text'=>'nullable|string',
            'commission_rate'=>'nullable',
            'commission_text'=>'nullable|string',
            'bank_account_FN'=>'nullable|string',
            'bank_account_SN'=>'nullable|string',
            'who_are_us'=>'nullable|string',
            'app_title'=>'nullable|string',
        ]);

        $this->settingService->update($request,$id);

        return back()->with('success','تم تحديث الاعدادات');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
