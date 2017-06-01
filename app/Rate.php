<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['label','index1','index2','color','category_id'];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
}
