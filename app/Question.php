<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
    	'title','type_id','category_id','user_id'
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    public function type()
    {
    	return $this->belongsTo(Type::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function option()
    {
    	return $this->hasMany(Option::class);
    }
    public function userTestResult()
    {
    	return $this->hasMany(UserTestResult::class);
    }
    public function testQuestion()
    {
    	return $this->hasMany(TestQuestion::class);
    }

    public function getAllQuestion()
    {
        return self::get();
    }
    public function getQuestionByID($id)
    {
        return self::find($id);
    }
    public function getQuestionByCategory($category)
    {
        return self::select()->where('category_id',$category)->get()->toArray();
    }
}
