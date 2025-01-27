<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DniLetter extends Model
{
    protected $table = 'dni_letters';

    protected $fillable = ['letter'];
}
