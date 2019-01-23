<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['name','slug','category_id','parent_id','thumbnail','tags','language','origin','type','total_view','file'];

    public function category(){
    	return $this->hasOne('App\Model\Category', 'id', 'category_id');
    }

    public function parent(){
    	return $this->hasOne('App\Model\Category', 'id', 'parent_id');
    }
}
