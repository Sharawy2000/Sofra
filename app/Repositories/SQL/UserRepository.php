<?php 
namespace App\Repositories\SQL;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    protected $user;

    public function __construct(User $user){
        parent::__construct($user);
        $this->user = $user;
    }

    public function validateLogin($data){
        return $this->user->where('email',$data)->first();
    }

}