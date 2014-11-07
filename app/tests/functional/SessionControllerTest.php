<?php
 
class SessionControllerTest extends TestCase{

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
    public function testCreate()
    {
      $this->call('GET', 'login');
     
      $this->assertResponseOk();
    }

    /**
     * Test Store failure
     */
    public function testStoreFailure()
    {
      Auth::shouldReceive('attempt')->andReturn(false);
     
      $this->call('POST', 'login');
     
      $this->assertRedirectedToRoute('session.create');
      $this->assertSessionHas('flash');
    }

    /**
     * Test Store success
     */
    public function testStoreSuccess()
    {
      Auth::shouldReceive('attempt')->andReturn(true);
     
      $this->call('POST', 'login');
     
      // $this->assertRedirectedToRoute('users.index');
    }
     
}