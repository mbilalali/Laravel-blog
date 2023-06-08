<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function posts(){
        return $this->belongsTo(Post::class,'post_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reply(){
        return $this->hasMany('App\Models\Comment' , 'parent_id','id')->where('user_id', '!=','2');
    }

}
