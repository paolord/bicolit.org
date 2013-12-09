<?php

use Woodling\Woodling;
use Carbon\Carbon;


Woodling::seed('Home', array('class' => 'Page', 'do' => function($blueprint)
{
    $blueprint->slug = 'home';
    $blueprint->created_at = Carbon::now();
    $blueprint->updated_at = Carbon::now();
}));

Woodling::seed('About', array('class' => 'Page', 'do' => function($blueprint)
{
    $blueprint->slug = 'about';
    $blueprint->created_at = Carbon::now();
    $blueprint->updated_at = Carbon::now();
}));


Woodling::seed('ContactUs', array('class' => 'Page', 'do' => function($blueprint)
{
    $blueprint->slug = 'contact-us';
    $blueprint->created_at = Carbon::now();
    $blueprint->updated_at = Carbon::now();
}));
