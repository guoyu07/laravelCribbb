<?php

use LaravelBook\Ardent\Ardent;

// 3. setting-up-your-first-laravel-4-model ADD
class Post extends Ardent {
 
    protected $fillable = array('body');

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'user_id' => 'required|numeric',
        'clique_id' => 'required|numeric'
    );

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Clique relationship
     */
    public function clique()
    {
        return $this->belongsTo('Clique');
    }

    /**
     * Comment relationship
     *
     * Now when I create future Models that also have comments, I can just add the last method to the new Model so that it also has comments.
     */
    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }
   
}