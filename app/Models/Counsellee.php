<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class Counsellee extends Authenticatable
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Search for Counsellee's username
     * @param string $name
     * @return mixed
     */
    public static function searchCounselleeUsername(string $name)
    {
        return self::whereOneLike('username', $name);
    }

    /**
     * Search for Multiple fields from the Counsellee's table
     * @param array $search
     * @return mixed
     */
    public static function searchCounselleeFields(array $search)
    {
        $attributes = ['username', 'firstname', 'lastname', 'email'];
        return self::whereMultiLike($attributes, $search);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
