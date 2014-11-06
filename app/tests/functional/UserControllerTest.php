<?php
 
class UserControllerTest extends TestCase {

    //The setUp() method is run before any of the tests. Here we are grabbing a copy of the UserRepository and creating a new mock.
    public function setUp()
    {
        parent::setUp();
        $this->mock = $this->mock('Yiqifu\Storage\User\UserRepository');
    }
    
    //In the mock() method, $this->app->instance tells Laravel’s IoC container to bind the $mock instance to the UserRepository class. This means that whenever Laravel wants to use this class, it will use the mock instead.
    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }

    //Tests go here
    //In this test I’m asking the mock to call the all() method once on the UserRepository. I then call the page using a GET request and then I assert that the response was ok.
    public function testIndex()
    {
        $this->mock->shouldReceive('all')->once();
        $this->call('GET', 'user'); //This will print a user on screen
        $this->assertResponseOk();
    }
}