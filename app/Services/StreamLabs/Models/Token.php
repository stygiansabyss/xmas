<?php

namespace App\Services\StreamLabs\Models;

use App\Models\BaseModel;

/**
 * App\Services\StreamLabs\Models\Token
 *
 * @property integer $id
 * @property integer $twitch_id
 * @property string $channel
 * @property string $api_token
 * @property string $access_token
 * @property string $refresh_token
 * @property \Carbon\Carbon $expires_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereTwitchId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereChannel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereApiToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereAccessToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereRefreshToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereExpiresAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 * @mixin \Eloquent
 */
class Token extends BaseModel
{
    public $table = 'stream_labs_tokens';

    protected $fillable = [
        'twitch_id',
        'channel',
        'api_token',
        'access_token',
        'refresh_token',
        'expires_at',
    ];

    protected $dates = [
        'expires_at',
    ];

    public function getExpiresAtAttribute()
    {
        return $this->getDate('expires_at');
    }

    public function setExpiresAtAttribute($value)
    {
        $this->setDate('expires_at', $value);
    }
}
