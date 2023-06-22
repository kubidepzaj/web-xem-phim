<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'slug',
        'status',
        // Các trường khác
    ];

    public function movie(){
        return $this ->hasMany(Movie::class)->orderBy('id','DESC');
    }
}
