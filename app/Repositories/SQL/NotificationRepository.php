<?php 
namespace App\Repositories\SQL;

use App\Models\Notification;
use App\Repositories\Interface\NotificationRepositoryInterface;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface{
    protected $notification;

    public function __construct(Notification $notification){
        parent::__construct($notification);
    }

    public function all($model){
        return $model->notifications()->latest()->paginate(5);
    }

    public function add($data,$model){
        return $model->notifications()->create($data);
    }

}