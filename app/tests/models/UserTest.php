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
        // Create a new Clique
        $clique = FactoryMuffin::create('Clique');
        // $this->assertEquals($clique->id, 1);

        $post = FactoryMuffin::create('Post');

        // echo "\n\r".
        //      '$post->user->mobile: '.
        //      $post->user->mobile.
        //      "\n\r".
        //      '$post->body: '.
        //      $post->body.
        //      "\n\r".
        //      '$post->user->username: '.
        //      $post->user->username.
        //      "\n\r";

        // Set the clique_id
        $post->clique_id = $clique->id;

        $this->assertInstanceOf('Post', $post);
        $this->assertInstanceOf('User', $post->user);
    }

    /**
     * Test a user can follower other users
     */
    public function testUserCanFollowerUsers()
    {
        // Create users
        $philip = FactoryMuffin::create('User');
        $jack = FactoryMuffin::create('User');
        $ev = FactoryMuffin::create('User');
        $biz = FactoryMuffin::create('User');

        // echo $philip->follow;

        // First set
        $philip->follow()->save($jack);

        // // First tests
        $this->assertCount(1, $philip->follow);
        $this->assertCount(0, $philip->followers);

        // Second set
        $jack->follow()->save($ev);
        $jack->follow()->save($biz);

        // Second tests
        $this->assertCount(2, $jack->follow);
        $this->assertCount(1, $jack->followers);

        // Third set
        $ev->follow()->save($jack);
        $ev->follow()->save($philip);
        $ev->follow()->save($biz);

        // Third tests
        $this->assertCount(3, $ev->follow);
        $this->assertCount(1, $ev->followers);

        // Fourth set
        $biz->follow()->save($jack);
        $biz->follow()->save($ev);

        // Fourth tests
        $this->assertCount(2, $biz->follow);
        $this->assertCount(2, $biz->followers);
    }

    public function testNameIsRequired()
    {
        // Create a new Clique
        $clique = new Clique;
        // $clique = FactoryMuffin::create('Clique');

        // Post should not save
        $this->assertFalse($clique->save());

        // Save the errors
        $errors = $clique->errors()->all();

        // echo $errors[0].$clique;

        // There should be 1 error
        $this->assertCount(1, $errors);

        // The error should be set
        $this->assertEquals($errors[0], "The name field is required.");
    }

    public function testCliqueUserRelationship()
    {
        // Create a new Clique
        $clique = FactoryMuffin::create('Clique');

        // Create two Users
        $user1 = FactoryMuffin::create('User');
        $user2 = FactoryMuffin::create('User');

        // Save Users to the Clique
        $clique->users()->save($user1);
        $clique->users()->save($user2);

        // Count number of Users
        $this->assertCount(2, $clique->users);
    }

    /**
     *  Test adding new comment
     */
    public function testAddingNewComment()
    {
        // Create a new Post
        $post = FactoryMuffin::create('Post');

        // Create a new Comment
        // $comment = new Comment(array('body' => 'A new comment.'));
        // echo $comment;
        $comment1 = FactoryMuffin::create('Comment');
        // echo $comment1;

        // Save the Comment to the Post
        $post->comments()->save($comment1);

        // This Post should have one comment
        $this->assertCount(1, $post->comments);
    }

    //Clean up the objects that were created in tests above
    public static function tearDownAfterClass()
    {
        FactoryMuffin::deleteSaved();
    }

}