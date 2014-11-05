<?php

class UserTest extends TestCase {
    // 4. getting-started-with-testing-laravel-4-models ADD
    // public function testThatTrueIsTrue()
    // {
    //     $this->assertTrue(true);
    // }

    /** 4. getting-started-with-testing-laravel-4-models ADD
     * Username is required
     */
    public function testUsernameIsRequired()
    {
        // Create a new User
        $user = new User;
        $user->email = "name@domain.com";
        $user->password = "password";
        $user->password_confirmation = "password";

        // User should not save
        $this->assertFalse($user->save());

        // Save the errors
        $errors = $user->errors()->all();

        // There should be 1 error
        $this->assertCount(1, $errors);

        // The username error should be set
        $this->assertEquals($errors[0], "The username field is required.");
    }
}