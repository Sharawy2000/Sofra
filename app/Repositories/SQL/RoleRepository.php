<?php 
namespace App\Repositories\SQL;

use App\Models\City;
use App\Repositories\Interface\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface{
    protected $role;

    public function __construct(Role $role){
        parent::__construct($role);
    }

    // public function attach($role,$permission_list){
    //     $role->permissions()->detach();
    //     $role->permissions()->attach($permission_list);
    // }
    // public function sync($role,$permission_list){
    //     $role->permissions()->sync($permission_list);
    // }

}