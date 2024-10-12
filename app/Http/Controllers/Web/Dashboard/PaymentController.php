<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService){
        $this->paymentService = $paymentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payments=$this->paymentService->getfilterPayments($request);

        return view('dashboard.payments.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.payments.create',);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id'=>'required|integer|exists:restaurants,id',
            'amount_paid'=>'required|integer',
            'payment_date'=>'required|date',
            'notes'=>'required|string'

        ]);

        $this->paymentService->store($request);

        return back()->with('success','تم إضافة المبلغ المدفوع');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment=$this->paymentService->get($id);
        return view('dashboard.payments.show',get_defined_vars());

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment=$this->paymentService->get($id);
        return view('dashboard.payments.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'restaurant_id'=>'nullable|integer|exists:restaurants,id',
            'amount_paid'=>'nullable|string',
            'payment_date'=>'nullable|date',
            'notes'=>'nullable|string'

        ]);

        $this->paymentService->update($request, $id);

        return back()->with('success','تم تحديث المبلغ المدفوع');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->paymentService->delete($id);

        return back()->with('success','تم حذف المبلغ المدفوع');

    }
}
