<?php

// 3. setting-up-your-first-laravel-4-model ADD
class Post extends Eloquent {
 
    protected $fillable = array('body');

    public function user()
    {
        return $this->belongsTo('User');
    }
   
}