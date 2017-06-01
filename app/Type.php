<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['type'];

    public function question()
    {
    	return $this->hasMany(Question::class);
    }
    public function getAllType()
    {
    	return self::get();
    }
    public function getTypeByID($id)
    {
    	return self::find($id);
    }
}
