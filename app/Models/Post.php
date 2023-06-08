<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];


    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tag(){
        return $this->belongsTo(Tag::class);
    }
    public function comments($id){
        //dd($id);
        return $this->hasMany(Comment::class)->where('parent_id', $id) ;
    }
    public function mainComments(){
        //dd($id);
        return $this->hasMany(Comment::class)->where('parent_id', '0') ;
    }

    // hasmany --- samne walay table me meri table ki mulitple ids
    // belongsto --- agr mere table me kisi or table ki id ho
    // hasone

}
