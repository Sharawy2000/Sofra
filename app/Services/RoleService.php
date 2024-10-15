<?php 
namespace App\Services;

use App\Repositories\Interface\RoleRepositoryInterface;

class RoleService extends BaseService
{
    protected $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository){
        parent::__construct($roleRepository);
        $this->roleRepository = $roleRepository;
    }

    public function attachPermissions($request,$role){
        if($request->permissions != null){
            $this->roleRepository->attach($role,'permissions',$request->permissions);

        }
    }
    public function syncPermissions($request,$role){
        $this->roleRepository->sync($role,'permissions',$request->permissions);

    }
}