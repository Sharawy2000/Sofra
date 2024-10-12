<?php 
namespace App\Repositories\SQL;

use App\Models\Comment;
use App\Repositories\Interface\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    protected $comment;

    public function __construct(Comment $comment){
        parent::__construct($comment);
    }

    public function all($model){
        return $model->comments()->latest()->paginate(5);
    }

    

}