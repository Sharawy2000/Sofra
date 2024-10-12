<?php 
namespace App\Services;

use App\Repositories\Interface\PaymentMethodRepositoryInterface;

class PaymentMethodService extends BaseService
{
    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository){
        parent::__construct($paymentMethodRepository);
    }
}