<?php

use League\FactoryMuffin\Facade as FactoryMuffin;
 
FactoryMuffin::define('Post', array(
    'user_id' => 'factory|User',
    'body' => "sentence|5"
));
 
FactoryMuffin::define('User', array(
    'username' => "unique:randomNumber|8",
    'email' => "unique:email",
    'password' => "12345678",
    'password_confirmation' => "12345678"
    // 'mobile' => "unique:randomNumber|9",
    // 'gender' => 'boolean',
    // 'name' => "name",
    // 'profile_pic' => 'optional:imageUrl|400;400'
));