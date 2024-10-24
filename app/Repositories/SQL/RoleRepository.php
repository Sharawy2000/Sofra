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

}
