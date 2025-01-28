<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DniLetter extends Model
{
    use HasFactory;
    
    protected $table = 'dni_letters';

    protected $fillable = ['letter'];
}
