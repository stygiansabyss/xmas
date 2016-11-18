<?php

namespace App\Services\Administrating\Models;

use App\Models\BaseModel;

class Asset extends BaseModel
{
    protected $table = 'assets';

    protected $fillable = [
        'name',
        'path',
        'width',
        'height'
    ];
}
