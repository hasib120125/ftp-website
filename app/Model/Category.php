<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
    protected $fillable = [
        'name', 'slug','type','parent_id','icon','sort'
    ];

    public function getParent(){
    	return $this->hasOne('App\Model\Category','id','parent_id');
    }
}
