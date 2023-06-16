<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;
    use HasFactory;
    public $table = 'episodes';
    public function movie(){
        //mot tap thuoc 1 phim
        return $this->belongsTo(Movie::class);
    }
}
