<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = ['activity'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}