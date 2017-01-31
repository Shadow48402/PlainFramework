<?php
/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: config.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 02:22
 **/

$path = isset($_GET['path']) ? $_GET['path'] : '';
return array(
    'general' => [
        'app_name' => 'PlainFramework',
        'url' => 'localhost:8080',
        'path' => $path,
        'default_language' => 'nl'
    ],
    'database' => [
        'enable' => true,
        'host' => '127.0.0.1',
        'database' => 'plainframework',
        'username' => 'root',
        'password' => 'root',
        'prefix' => 'pf_',
        'encoding' => 'utf8',
        'debug' => true
    ],
    'dir' => [
        'controllers' => 'controllers',
        'controller_prefix' => 'controller.',
        'models' => 'models',
        'model_prefix' => 'model.',
        'libs' => 'libs'
    ],
    'sessions' => [
        'enabled' => true,
        'primary_key' => 'id',
        'table_name' => 'users',
        'session_name' => 'user_session'
    ],
    'errors' => [
        '404' => 'errors/404'
    ],
    'tpl' => [
        'enabled' => true,
        'debug' => false,
        'path' => 'framework/libs/smarty/Smarty.class.php',
        'image_path' => 'framework/libs/simpleimage/SimpleImage.php',
        'views' => 'app/views/',
        'templates' => 'app/templates/',
        'default_template' => 'default',
        'compile' => 'framework/storage/templates_c',
        'configs' => 'framework/configs',
        'cache' => 'framework/storage/cache',
        'img_cache' => 'app/libs/images/cache/'
    ]
);