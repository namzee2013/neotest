<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
    	'link','expired','timetotal','user_id','category_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function testQuestion()
    {
    	return $this->hasMany(TestQuestion::class);
    }
    public function userTest()
    {
    	return $this->hasMany(UserTest::class);
    }
    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function getAllTest()
    {
        return self::get();
    }
    public function getTestByID($id)
    {
        return self::find($id);
    }
}
