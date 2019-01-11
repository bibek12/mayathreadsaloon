<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    //
    use SoftDeletes;
    // active data take
    public function scopeActive($query){
    	return $query->where('is_active',1);
    }
    
}