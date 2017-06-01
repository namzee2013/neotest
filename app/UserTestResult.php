<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTestResult extends Model
{
    protected $fillable = ['usertest_id','question_id','result','comment'];

    public function userTest()
    {
    	return $this->belongsTo(UserTest::class);
    }
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
}
