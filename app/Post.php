<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    // protected $table = 'posts';

    protected $fillable = ['title','category','caption','Image','price'];
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Comments(){
        return $this->hasMany('App\Comment');
    }
    
}
