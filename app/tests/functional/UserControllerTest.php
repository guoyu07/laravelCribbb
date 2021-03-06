<?php
 
class UserControllerTest extends TestCase {

    //The setUp() method is run before any of the tests. Here we are grabbing a copy of the UserRepository and creating a new mock.
    public function setUp()
    {
        //parent::setUp(); is called because we are overwriting the method of the parent class.
        parent::setUp();
        //Next I set the $this->mock property of the class to the return value of the $this->mock(); method. 前一个$this->mock是类属性, 后一个$this->mock()是下面定义的类方法
        $this->mock = $this->mock('Yiqifu\Storage\User\UserRepository');
    }
    
    //In the mock() method, $this->app->instance tells Laravel’s IoC container to bind the $mock instance to the UserRepository class. This means that whenever Laravel wants to use this class, it will use the mock instead.
    public function mock($class)
    {
        //creates a new mock
        $mock = Mockery::mock($class);
        //binding the mock to the name of the class in Laravel’s IoC container. This means, whenever Laravel is asked for this class, it will return my mocked version instead of the real thing.
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

    public function testCreate()
    {
        $this->call('GET', 'users/create');
        $this->assertResponseOk();
    }

    public function testStoreFails()
    {
        $this->mock->shouldReceive('create')
                 ->once()
                 ->andReturn(Mockery::mock(array(
                     'isSaved' => false,
                     'errors' => array()
                   )));

        $this->call('POST', 'users');

        $this->assertRedirectedToRoute('users.create');
        $this->assertSessionHasErrors();
    }

    public function testStoreSuccess()
    {
        $this->mock->shouldReceive('create')
                 ->once()
                 ->andReturn(Mockery::mock(array(
                     'isSaved' => true
                   )));

        $this->call('POST', 'users');
        $this->assertRedirectedToRoute('users.index');
        $this->assertSessionHas('flash');
    }

    public function testShow()
    {
        $this->mock->shouldReceive('find')
                 ->once()
                 ->with(1);

        $this->call('GET', 'users/1');

        $this->assertResponseOk();
    }

    public function testEdit()
    {
        $this->call('GET', 'users/1/edit');
        $this->assertResponseOk();
    }

    public function testUpdateFails()
    {
        $this->mock->shouldReceive('update')
                 ->once()
                 ->with(1)
                 ->andReturn(Mockery::mock(array(
                     'isSaved' => false,
                     'errors' => array()
                   )));

        $this->call('PUT', 'users/1');

        $this->assertRedirectedToRoute('users.edit', 1);
        $this->assertSessionHasErrors();
    }
     
    public function testUpdateSuccess()
    {
        $this->mock->shouldReceive('update')
                 ->once()
                 ->with(1)
                 ->andReturn(Mockery::mock(array(
                     'isSaved' => true
                   )));

        $this->call('PUT', 'users/1');

        $this->assertRedirectedToRoute('users.show', 1);
        $this->assertSessionHas('flash');
    }

    public function testDelete()
    {
        $this->mock->shouldReceive('delete')
                 ->once()
                 ->with(1);

        $this->call('DELETE', 'users/1');

        $this->assertResponseOk();
    }

    // //Between each test, you need to clean up Mockery so that any expectations from the previous test do not interfere with the current test. To do that, we can simply create a tearDown() method: The static method close() cleans up the Mockery container used by the current test, and runs any verification tasks needed for your expectations.
    // public function tearDown()
    // {
    //     Mockery::close();
    // }
}