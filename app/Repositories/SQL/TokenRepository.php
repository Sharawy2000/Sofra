<?php 
namespace App\Repositories\SQL;

use App\Models\Token;
use App\Repositories\Interface\TokenRepositoryInterface;

class TokenRepository extends BaseRepository implements TokenRepositoryInterface
{

    protected $fcmToken;

    public function __construct(Token $fcmToken){
        parent::__construct($fcmToken);
    }

    public function get($module){
        return $module->fcmTokens()->pluck('fcm_token')->first();
    }
    public function add($data,$module){
        $module->fcmTokens()->delete();
        return $module->fcmTokens()->create($data);
    }
    
    

}