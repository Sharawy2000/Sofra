<?php 
namespace App\Services;

use App\Repositories\Interface\PaymentRepositoryInterface;

class PaymentService extends BaseService
{
    protected $paymentRepository;
    public function __construct(PaymentRepositoryInterface $paymentRepository){
        parent::__construct($paymentRepository);
        $this->paymentRepository = $paymentRepository;
    }

    public function getfilterPayments($request){
        if($request->search != null){

            return $this->paymentRepository->filter($request->search);
            
        }else{

            return $this->all();
        }
    }
}