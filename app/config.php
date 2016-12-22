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

return array(
    'general' => [
        'app_name' => 'PlainFramework',
        'url' => 'localhost:8080',
        'path' => $_GET['path']
    ],
    'database' => [
        'enable' => true,
        'host' => '127.0.0.1',
        'database' => 'plainframework',
        'username' => 'root',
        'password' => 'root',
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
        'views' => 'app/views/',
        'templates' => 'app/templates/',
        'default_template' => 'default',
        'compile' => 'framework/storage/templates_c',
        'configs' => 'framework/configs',
        'cache' => 'framework/storage/cache'
    ]
);