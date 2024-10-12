<?php 
namespace App\Services;

use App\Repositories\Interface\ContactMessageRepositoryInterface;

class ContactMessageService extends BaseService
{
    protected $contactMessageRepository;
    public function __construct(ContactMessageRepositoryInterface $contactMessageRepository){
        parent::__construct($contactMessageRepository);
        $this->contactMessageRepository=$contactMessageRepository;
    }

    public function getfilterMessages($request){
        if($request->search != null){

            return $this->contactMessageRepository->filter($request->search);

        }else{

            return $this->all();
        }
    }
}