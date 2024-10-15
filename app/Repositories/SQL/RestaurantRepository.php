<?php
namespace App\Repositories\SQL;

use App\Enums\OrderStatus;
use App\Models\Restaurant;
use App\Repositories\Interface\RestaurantRepositoryInterface;


class RestaurantRepository extends BaseRepository implements RestaurantRepositoryInterface
{
    protected $restaurant;

    public function __construct(Restaurant $restaurant){
        parent::__construct($restaurant);
        $this->restaurant = $restaurant;

    }
    public function validateLogin($data){
        return $this->restaurant->where('phone',$data['phone'])->first();
    }
    public function validateResetCode($data){
        return $this->restaurant->where('reset_code',$data)->first();
    }
    public function createToken($restaurant){
        return $restaurant->createToken('Personal Access Token',['*'],now()->addMonth())->plainTextToken;
    }
    public function currentToken($restaurant){
        return $restaurant->currentAccessToken();
    }
    public function removeToken($restaurant){
        $this->currentToken($restaurant)->delete();
    }
    public function overallRateCalc($restaurant){
        $rates=$restaurant->comments()->pluck('rate')->sum();
        $reviews = $restaurant->comments()->whereNotNull('rate')->count();
        $reviews == 0 ? $restaurant->overall_rate = 0 : $restaurant->overall_rate = round($rates / $reviews);
        $restaurant->save();
    }
    public function myComissionsCalc($restaurant){

        $completedOrderPrices=$restaurant->orders()->where('status',OrderStatus::DELIVERED)->pluck('total_price')->sum();
        $completedOrderCommissions=$restaurant->orders()->where('status',OrderStatus::DELIVERED)->pluck('commission_amount')->sum();
        $payedAmount=$restaurant->payments()->pluck('amount_paid')->sum();
        $requiredAmount=$completedOrderCommissions - $payedAmount;

        return [
            'completedOrderPrices'=>$completedOrderPrices,
            'completedOrderCommissions'=>$completedOrderCommissions,
            'payedAmount'=>$payedAmount,
            'requiredAmount'=>$requiredAmount
        ];
    }

    public function removeAllTokens($id){
        $restaurant=$this->find($id);
        return $restaurant->tokens()->delete();
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
