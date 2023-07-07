<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'bookmarks';
    protected $fillable = [
        'movie_id', 'publisher_id', 'created_at'
    ];
    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }
    public function movie(){
        return $this ->belongsTo(Movie::class);
    }
}
