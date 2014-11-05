<?php
// 4. getting-started-with-testing-laravel-4-models ADD
return array(
    'default' => 'sqlite',
    'connections' => array(
        'sqlite' => array(
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => ''
        ),
    )
);