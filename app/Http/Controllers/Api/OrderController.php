<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Traits\Helper;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use Helper;

    protected $orderService;

    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    
    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string',
            'payment_method_id' => 'required|exists:payment_methods,id', 
            'special_order' => 'nullable|string',
            'products' => 'required|array', 
            'products.*' => 'exists:products,id',
            'quantities' => 'nullable|array', 
            'quantities.*' => 'integer|min:1', 
        ]);

        $order = $this->orderService->placeOrder($request);

        return $this->responseJson('تم إنشاء الطلب بنجاح', $order->load(['products','paymentMethod']) , 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = $this->orderService->get($id);

        return $this->responseJson('الطلب',$order);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'status'=>'required|integer|in:0,1,2,3,4'
        ]);

        $order = $this->orderService->updateOrder($data,$id);
        
        return $this->responseJson('تم تحديث الطلب بنجاح', $order->load(['products','paymentMethod']));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->orderService->delete($id);

        return $this->responseJson('تم حذف الطلب');

    }
}
