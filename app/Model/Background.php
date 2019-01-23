<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    protected $table = 'backgrounds';
    protected $fillable = [
        'image', 'sort'
    ];
}
