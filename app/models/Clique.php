<?php

use LaravelBook\Ardent\Ardent;

class Clique extends Ardent {
    /**
     * User relationship
     */
    public function users(){
        return $this->belongsToMany('User');
    }
    /**
     * Post relationship
     */
    public function posts()
    {
        return $this->hasMany('Post');
    }

    // /**
    //  * Factory
    //  */
    // public static $factory = array(
    //     'name' => 'string'
    // );

    /**
     * Properties that can be mass assigned
     *
     * @var array
     */
    protected $fillable = array('name');
     
    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'name' => 'required',
    );
}