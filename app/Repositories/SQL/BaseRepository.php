<?php
namespace App\Repositories\SQL;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interface\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->latest()->paginate(5);
    }
    public function store($data){
        return $this->model->create($data);
    }
    public function find($id){
        return $this->model->findOrFail($id);
    }
    public function update($data,$id){
        $model=$this->find($id);
        $model->update($data);
        return $model;
    }
    public function remove($id){
        $module=$this->find($id);
        $module->delete();
    }
    public function attach($model,$relation,$id,$data=[]){
        $model->$relation()->attach($id,$data);
    }
    public function detach($model,$relation){
        $model->$relation()->detach();
    }
    public function sync($model,$relation,$id){
        $model->$relation()->sync($id);
    }


}
