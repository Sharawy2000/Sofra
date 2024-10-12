<?php 
namespace App\Repositories\SQL;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
    protected $category;

    public function __construct(Category $category){
        parent::__construct($category);
    }

}