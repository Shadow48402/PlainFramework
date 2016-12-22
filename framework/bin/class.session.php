<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: class.session.php
 *   Website: www.nielsha.nl
 *   Created at: 17-11-2016 19:40
 **/
class Session
{
    protected $primary_value;

    public function __construct($primary_value)
    {
        global $app;

        $this->primary_value = $primary_value;


        return true;
    }

    public function login()
    {
        global $app;


    }

    public function logout()
    {
        global $app;

        $config = $app->getConfig();
        session_destroy();
        setcookie($config['session']['cookie_name'], "", time()-3600);
    }

    public function isLoggedIn()
    {
        global $app;

        $config = $app->getConfig();
        $session_field = $config['session']['session_name'];
        if(isset($_SESSION[$session_field]))
            return true;

        return false;
    }

    public function generateSessionKey()
    {

    }
}