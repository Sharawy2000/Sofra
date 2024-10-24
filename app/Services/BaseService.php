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

        return $this->repository->store($request->all());

    }

    public function get($id){

        return $this->repository->find($id);

    }
    public function update($request, $id){

        return $this->repository->update($request->all(),$id);

    }

    public function delete($id){

        $this->repository->remove($id);

    }

    public function removeImage($id){

        $model = $this->get($id);
        unlink($model->image);
    }

}
