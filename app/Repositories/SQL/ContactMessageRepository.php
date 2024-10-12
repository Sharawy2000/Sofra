<?php 
namespace App\Repositories\SQL;

use App\Models\ContactMessage;
use App\Models\Notification;
use App\Repositories\Interface\ContactMessageRepositoryInterface;

class ContactMessageRepository extends BaseRepository implements ContactMessageRepositoryInterface{
    protected $contact;

    public function __construct(ContactMessage $contact){
        $this->contact = $contact;
        parent::__construct($contact);
    }

    public function filter($search){
        return $this->contact->where('name','like','%'. $search . '%')
        ->orWhere('email','like','%'. $search . '%')
        ->orWhere('phone','like','%'. $search . '%')
        ->latest()
        ->paginate(5);
    }

}