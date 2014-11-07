<?php
 
use Yiqifu\Storage\User\UserRepository as User;
 
class SessionController extends BaseController {
 
  /**
   * User Repository
   */
  protected $user;
 
  /**
   * Inject the User Repository
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }
 
  /**
   * Show the form for creating a new Session
   */
  public function create()
  {
    return View::make('session.create');
  }
 
  public function store()
  {
    // var_dump(Auth::attempt(array('email' => 'alexgzhou@163.com', 'password' => 'wlrhzts001')));
    if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
    {
      // return Redirect::intended('/');
      return Redirect::route('users.index');
    }
    return Redirect::route('session.create')
            ->withInput()
            ->with('login_errors', true);
  }
 
  public function destroy()
  {
    Auth::logout();
 
    return View::make('session.destroy');
  }
 
}