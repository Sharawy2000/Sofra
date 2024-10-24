<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Traits\Helper;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    use Helper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->all();

        return $this->responseJson('المنتجات',$products);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'image'=>'required|file|mimes:png,jpg,jpeg,gif,svg,ico',
            'price'=>'required',
            'order_duration'=>'required',
            'price_in_offer'=>'nullable',
       ]);

        $product = $this->productService->placeProduct($request);

        return $this->responseJson('تم انشاء المنتج',$product);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product= $this->productService->get($id);

        return $this->responseJson('المنتج',$product);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'nullable|string',
            'description'=>'nullable|string',
            'image'=>'nullable|file|mimes:png,jpg,jpeg,gif,svg,ico',
            'price'=>'nullable',
            'order_duration'=>'nullable',
            'price_in_offer'=>'nullable',
       ]);

       $product = $this->productService->updateProduct($request,$id);

       return $this->responseJson('تم تحديث المنتج',$product);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->removeImage($id);

        $this->productService->delete($id);

        return $this->responseJson('تم حذف المنتج');

    }
}
