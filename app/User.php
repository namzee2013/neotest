<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id','avatar'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function question()
    {
        return $this->hasMany(Question::class);
    }
    public function test()
    {
        return $this->hasMany(Test::class);
    }
    public function userTest()
    {
        return $this->hasMany(UserTest::class);
    }
}
