<?php
namespace App\Repositories\SQL;

use App\Models\Client;
use App\Repositories\Interface\ClientRepositoryInterface;


class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    protected $client;
    public function __construct(Client $client){
        parent::__construct($client);
        $this->client = $client;
    }
    public function validateLogin($data){
        return $this->client->where('phone',$data['phone'])->first();
    }
    public function validateResetCode($data){
        return $this->client->where('reset_code',$data)->first();
    }
    public function createToken($client){
        return $client->createToken('Personal Access Token',['*'],now()->addMonth())->plainTextToken;
    }
    public function removeToken($client){
        $client->currentAccessToken()->delete();
    }
    public function removeAllTokens($id){
        $client=$this->find($id);
        return $client->tokens()->delete();
    }

    public function filter($search){
        return $this->model->whereHas('neighborhood',function($query) use ($search){
            $query->whereHas('city',function($query) use ($search){
                $query->where('name','like','%' . $search . '%');
            })
            ->orWhere('name','like','%' . $search . '%');
        })
        ->orWhere('phone',$search)
        ->orWhere('name','like','%' . $search . '%')
        ->orWhere('email','like','%' . $search . '%')
        ->latest()
        ->paginate(5);

    }


}
