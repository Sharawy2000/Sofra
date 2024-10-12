<?php 
namespace App\Services;

use App\Repositories\Interface\SettingRepositoryInterface;

class SettingService extends BaseService
{
    public function __construct(SettingRepositoryInterface $settingRepository){
        parent::__construct($settingRepository);
    }
}