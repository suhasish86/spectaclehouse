<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function get_user_by_email($email = false)
    {
        $user = User::where('email', '=', $email)->first();
        if(!empty($user)) return $user;
        return false;
    }
}
