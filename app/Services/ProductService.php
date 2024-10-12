<?php 
namespace App\Services;

use App\Repositories\Interface\ProductRepositoryInterface;
use App\Traits\Helper;

class ProductService extends BaseService
{
    use Helper;
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository){
        parent::__construct($productRepository);
        $this->productRepository=$productRepository;
    }

    public function getRestaurant(){

        $restaurant=auth()->guard('restaurant')->user();

        if(!$restaurant){
            abort(401, 'لا يوجد بيانات');
            
        }
        return $restaurant;
    }

    public function placeProduct($request){

        $restaurant=$this->getRestaurant();

        $request->merge(['restaurant_id' => $restaurant->id]);
        
        $product=$this->productRepository->store($request->all());

        if($request->hasFile('image')){
            $this->UploadImage($request,'image',$product,'products/images');
        }

        return $product;

    }

    public function updateProduct($request, $id){

        $this->getRestaurant();

        $product=$this->productRepository->update($request->except('image'),$id);

        if($request->has('image')){
            $this->UploadImage($request,'image',$product,'products/images');
        }

        return $product;

    }

}