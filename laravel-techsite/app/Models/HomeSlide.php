<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;
    protected $guarded = []; //same as fillable meaning nullable

//    protected $fillable = [
//        'name',
//        'username',
//        'email',
//        'password',
//    ];
}
