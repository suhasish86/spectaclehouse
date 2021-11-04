<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function get_user_by_email($email);

}
