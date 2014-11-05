<?php

use League\FactoryMuffin\Facade as FactoryMuffin;

// class UserTest extends TestCase {
//     // 4. getting-started-with-testing-laravel-4-models ADD
//     // public function testThatTrueIsTrue()
//     // {
//     //     $this->assertTrue(true);
//     // }

//     /** 4. getting-started-with-testing-laravel-4-models ADD
//      * Username is required
//      */
//     public function testUsernameIsRequired()
//     {
//         // Create a new User
//         $user = new User;
//         $user->email = "name@domain.com";
//         $user->password = "password";
//         $user->password_confirmation = "password";

//         // User should not save
//         $this->assertFalse($user->save());

//         // Save the errors
//         $errors = $user->errors()->all();

//         // There should be 1 error
//         $this->assertCount(1, $errors);

//         // The username error should be set
//         $this->assertEquals($errors[0], "The username field is required.");
//     }
// }

class UserTest extends PHPUnit_Framework_TestCase {

    //The setupBeforeClass() method will automatically include our factory definitions earlier so they are available during the tests.
    public static function setupBeforeClass()
    {
        FactoryMuffin::loadFactories(__DIR__ . '/../factories');
    }

    //Tests goes here
    public function testCreateNewPost()
    {
        $post = FactoryMuffin::create('Post');
        $this->assertInstanceOf('Post', $post);
        $this->assertInstanceOf('User', $post->user);
    }

    //Clean up the objects that were created in tests above
    public static function tearDownAfterClass()
    {
        FactoryMuffin::deleteSaved();
    }

}