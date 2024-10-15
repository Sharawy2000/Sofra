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

        if($order['errorProduct']){
            return $this->responseJson('لا يوجد هذا المنتج', null, 404);
        }

        if($order['errorRestaurant']){
            return $this->responseJson('لا يوجد مطعم لهذا المنتج', null, 404);    
        }

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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->orderService->delete($id);

        return $this->responseJson('تم حذف الطلب');

    }

    // accept met -> accept order in service
    // check -> update ->
    public function acceptOrder($id){

        $order = $this->orderService->accept($id);

        if(!$order){
            return $this->responseJson('الطلب غير موجود حاليا',null,422);
        }
        if($order['orderError']){

            return $this->responseJson('لا توجد معلومات لهذا الطلب', null, 401);
        }

        return $this->responseJson('تم قبول الطلب ', $order->load(['products','paymentMethod']));

    }
    public function rejectOrder($id){

        $order = $this->orderService->reject($id);

        if(!$order){
            return $this->responseJson('الطلب غير موجود حاليا',null,422);
        }

        return $this->responseJson('تم رفض الطلب', $order->load(['products','paymentMethod']));
    }
    public function receivedOrder($id){
        
        $order = $this->orderService->received($id);
        
        if(!$order){
            return $this->responseJson('الطلب غير متوافق عليه حاليا',null,422);
        }
        
        return $this->responseJson('تم استلام الطلب', $order->load(['products','paymentMethod']));
    }
    public function cancelledOrder($id){
        
        $order = $this->orderService->cancelled($id);
        
        if(!$order){
            return $this->responseJson('الطلب غير متوافق عليه حاليا',null,422);
        }
        
        return $this->responseJson('تم إلغاء الطلب', $order->load(['products','paymentMethod']));
    }
    public function deliveredOrder($id){
        $order = $this->orderService->delivered($id);

        if(!$order){
            return $this->responseJson('الطلب لم يستلم بعد',null,422);
        }

        return $this->responseJson('تم توصيل الطلب', $order->load(['products','paymentMethod']));
    }
}
