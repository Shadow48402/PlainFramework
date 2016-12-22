<?php
/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: paths.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 09:14
 **/
return array(
    '/' => 'HomeController@home',
    'home' => 'HomeController@home',
    'test' => 'HomeController@test',
    'testings/$lala' => 'HomeController@testpath',
    'user/$user_name' => 'HomeController@testpath'
);