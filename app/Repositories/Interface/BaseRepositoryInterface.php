<?php
namespace App\Repositories\Interface;

interface BaseRepositoryInterface
{
    public function getAll();
    public function store($data);
    public function find($id);
    public function update($data,$id);
    public function remove($id);
    public function attach($model,$relation,$id,$data=[]);
    public function detach($model,$relation);
    public function sync($model,$relation,$id);





}
