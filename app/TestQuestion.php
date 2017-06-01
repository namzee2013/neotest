<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $fillable = ['test_id','question_id','mark_max'];

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
    public function test()
    {
    	return $this->belongsTo(Test::class);
    }
    public function getTestQuestionByID($id)
    {
    	return self::find($id);
    }

}
