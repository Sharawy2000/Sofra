<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\Helper;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Helper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return $this->responseJson('الاعدادات',$setting);
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
        $setting = Setting::first();
        return $this->responseJson('الاعدادات',$setting);
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
            'commission_rate'=>'nullable|string',
            'commission_text'=>'nullable|string',
            'bank_account_FN'=>'nullable|string',
            'bank_account_SN'=>'nullable|string',
            'who_are_us'=>'nullable|string',
            'app_title'=>'nullable|string',

        ]);

        $setting = Setting::first();

        $setting->update($request->all());
        $setting->save();

        return $this->responseJson('تم تحديث الاعدادات',$setting);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
