<?php

namespace App\Services\Authorizing\Models;

use App\Models\BaseModel;
use App\Models\User;
use NukaCode\Users\Models\Role;

class Access extends BaseModel
{
    protected $table = 'user_access';

    protected $fillable = [
        'email',
        'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
