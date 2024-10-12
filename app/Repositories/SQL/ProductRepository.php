<?php 
namespace App\Repositories\SQL;

use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface{
    protected $product;

    public function __construct(Product $product){
        parent::__construct($product);
    }

    public function all($model){
        return $model->products()->latest()->paginate(5);
    }

}