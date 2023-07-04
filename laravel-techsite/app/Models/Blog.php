<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];
    //create relationship btwn Blog and BlogCategory
    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id','id');
    }
}
