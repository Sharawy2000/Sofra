<?php 
namespace App\Services;

use App\Repositories\Interface\BaseRepositoryInterface;

class BaseService 
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function all(){

        return $this->repository->getAll();

    }

    public function store($request){
        
        $result=$this->repository->store($request->all());
        
        return $result;

    }

    public function get($id){
        
        $result=$this->repository->find($id);

        return $result;

    }
    public function update($request, $id){

        $result=$this->repository->update($request->all(),$id);

        return $result;

    }

    public function delete($id){

        $model = $this->repository->find($id);
        if($model->image){
            unlink($model->image);
        }
        $this->repository->remove($id);

    }
}