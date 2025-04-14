<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonLife extends Model
{
    protected $table = 'CommonLife';
    protected $fillable = ['user_id', 'title', 'description', 'done', 'doneby', 'comment'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
