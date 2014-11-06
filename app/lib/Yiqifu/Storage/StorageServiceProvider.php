<?php namespace Yiqifu\Storage;
 
use Illuminate\Support\ServiceProvider;

// If you remember back to my article on creating a Laravel 4 Package, the register method is automatically called on the Service Provider. This allows you to bootstrap your files so everything is loaded correctly.

// In this example, I’m binding the User Repository to the Eloquent User Repository. This means, whenever I want to use the User Repository, Laravel will automatically know that I want to use the Eloquent User Repository. If in the future I wanted to use Mongo instead, I would simply have to create a Mongo User Repository and update this binding.
 
class StorageServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->bind(
      'Yiqifu\Storage\User\UserRepository',
      'Yiqifu\Storage\User\EloquentUserRepository'
    );
  }
 
}