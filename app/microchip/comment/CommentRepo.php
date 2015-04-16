<?php namespace microchip\comment;

use microchip\base\BaseRepo;

class CommentRepo extends BaseRepo {

    public function getModel()
    {
        return new Comment();
    }

    public function newComment()
    {
        return $comment = new Comment();
    }
}