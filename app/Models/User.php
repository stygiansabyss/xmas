<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use NukaCode\Users\Models\User as BaseUser;
use NukaCode\Users\Traits\HasSocials;

class User extends BaseUser
{
    use HasSocials, Notifiable;
}
