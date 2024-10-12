<?php 
namespace App\Services;

use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        parent::__construct($categoryRepository);
    }
}