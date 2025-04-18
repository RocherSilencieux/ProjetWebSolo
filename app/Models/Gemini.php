<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gemini extends Model
{
    protected $table = 'gemini';
    protected $fillable = ['language','number_of_choices','number_of_questions','qcm'];
}
