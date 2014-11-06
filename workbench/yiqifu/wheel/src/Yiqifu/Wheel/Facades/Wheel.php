<?php namespace Yiqifu\Wheel\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Wheel extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'wheel'; }
 
}