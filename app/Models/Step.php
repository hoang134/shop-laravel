<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    //
    protected $table = 'steps';
    protected $fillable = ['step', 'title', 'content', 'location', 'created_at', 'updated_at'];
}
