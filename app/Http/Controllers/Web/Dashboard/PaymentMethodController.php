<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\PaymentMethodService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService){
        $this->paymentMethodService = $paymentMethodService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = $this->paymentMethodService->all();

        return view('dashboard.payment-methods.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.payment-methods.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string'
        ]);

        $this->paymentMethodService->store($request);

        return back()->with('success','تم إنشاء وسيلة الدفع بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentMethod = $this->paymentMethodService->get($id);

        return view('dashboard.payment-methods.show',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paymentMethod = $this->paymentMethodService->get($id);

        return view('dashboard.payment-methods.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'nullable|string'
        ]);

        $this->paymentMethodService->update($request,$id);

        return back()->with('success','تم تحديث وسيلة الدفع بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->paymentMethodService->delete($id);

        return back()->with('success','تم حذف وسيلة الدفع بنجاح');

    }
}
