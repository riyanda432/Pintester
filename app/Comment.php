<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['comment', 'user_id', 'post_id'];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Post()
    {
        return $this->belongsTo('App\Post');
    }
}
