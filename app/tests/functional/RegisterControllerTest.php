<?php
 
class RegisterControllerTest extends TestCase{

  //The setUp() method is run before any of the tests. Here we are grabbing a copy of the UserRepository and creating a new mock.
  public function setUp()
  {
    parent::setUp();
    $this->mock = $this->mock('Yiqifu\Storage\User\UserRepository');
  }
  
  public function mock($class)
  {
    $mock = Mockery::mock($class);
    $this->app->instance($class, $mock);    
    return $mock;
  }
 
  /**
   * Test Index
   */
  public function testIndex()
  {
    $this->call('GET', 'register');
 
    $this->assertResponseOk();
  }
 
  /**
   * Test Store fails
   */
  public function testStoreFails()
  {
    $this->mock->shouldReceive('create')
      ->once()
      ->andReturn(Mockery::mock(array('save' => false, 'errors' => array())));
 
    $this->call('POST', 'register');
 
    $this->assertRedirectedToRoute('register.index');
    $this->assertSessionHasErrors();
  }
 
  /**
   * Test Store success
   */
  public function testStoreSuccess()
  {
    $this->mock->shouldReceive('create')
      ->once()
      ->andReturn(Mockery::mock(array('save' => true)));
 
    $this->call('POST', 'register');
 
    $this->assertRedirectedToRoute('users.index');
    $this->assertSessionHas('flash');
  }
}