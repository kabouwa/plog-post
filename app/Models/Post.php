<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * SOFT DELETE : mark row as deleted without deleting
     */
    protected $fillable = [
        'title', 
        'description',
        'user_id',
        'image_path',
    ];


    // One to many eloquent relationship (name of function is name of cloumn + _id = user_id)
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Another method with personalized function name , need to specify foregin key column
    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }
}
