<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

// 3. setting-up-your-first-laravel-4-model	ADD
use LaravelBook\Ardent\Ardent;	

// 3. setting-up-your-first-laravel-4-model UPDATE
class User extends Ardent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	protected $fillable = array('username', 'email');
	protected $guarded = array('id', 'password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	 
	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}
	 
	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
		'username' => 'required|between:4,16',
		'email' => 'required|email',
		'password' => 'required|alpha_num|min:8|confirmed',
		'password_confirmation' => 'required|alpha_num|min:8',
	);

	public $autoPurgeRedundantAttributes = true;

	/**
	 * Post relationship
	 */
	public function posts()
	{
		return $this->hasMany('Post');
	}

	/**
	 * User following relationship
	 *
	 * The second argument of the belongsToMany() method allows you to define a table name that does not follow the normal convention and the third and forth arguments allow you to overwrite the conventional associated keys.
	 *
	 */
	public function follow()
	{
		return $this->belongsToMany('User', 'user_follows', 'user_id', 'follow_id');
	}
	/**
	 * User followers relationship
	 */
	public function followers()
	{
		return $this->belongsToMany('User', 'user_follows', 'follow_id', 'user_id');
	}

	/**
	 * Clique relationship
	 */
	public function clique(){
		return $this->belongsToMany('Clique');
	}

}
