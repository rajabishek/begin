<?php 

namespace Begin\Transformers;

use Begin\User;

class UserTransformer extends Transformer 
{
    /**
     * Transform the given user
     *
     * @param array $user
     * @return array
     */
    public function transform($user)
    {
        return [
            'name' => $user['name'],
            'email' => $user['email'],
        ];
    }
}