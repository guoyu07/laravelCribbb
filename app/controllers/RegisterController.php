<?php
 
use Yiqifu\Storage\User\UserRepository as User;
 
class RegisterController extends BaseController {
 
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

  public function index()
  {
    return View::make('register.index');
  }

  public function store()
  {
    $s = $this->user->create(Input::all());

    // var_dump(Input::all());
    // var_dump($s->username);
    $s->password = Input::get('password');
    if($s->save())
    {
      return Redirect::route('users.index')
        ->with('flash', 'The new user has been created');
    }

    return Redirect::route('register.index')
      ->withInput()
      ->withErrors($s->errors());
  }
 
}