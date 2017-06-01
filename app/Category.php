<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function question()
    {
    	return $this->hasMany(Question::class);
    }
    public function test()
    {
        return $this->hasMany(Test::class);
    }
    public function getAllCategory()
    {
      return self::get();
    }

    public function getCategoryByID($id)
    {
      return self::find($id);
    }
    public function rate()
    {
    	return $this->hasMany(Rate::class);
    }
}
