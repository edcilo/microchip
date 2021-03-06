<?php

namespace microchip\comment;

use microchip\base\BaseManager;

class CommentRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'comment'    => 'required',
            'suggestion' => 'boolean',
            'print'      => 'boolean',
            'sale_id'    => 'required|exists:sales,id',
            'user_id'    => 'required|exists:users,id',
        ];
    }

    public function prepareDate($data)
    {
        $this->stripTags($data);

        if (!isset($data['suggestion'])) {
            $data['suggestion'] = 0;
        }

        return $data;
    }
}
