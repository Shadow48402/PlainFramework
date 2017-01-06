<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: Response.php
 *   Website: www.nielsha.nl
 *   Created at: 17-11-2016 18:23
 **/
class Response
{

    public static function make($view_name, $values=[])
    {
        $view = new View($view_name);
        foreach($values as $key => $value)
        {
            $view->set($key, $value);
        }
        $view->display();
    }

    public static function code($response_code)
    {
        if (version_compare(phpversion(), '5.4.0', '<'))
            header('Not found', true, $response_code);
        else
            http_response_code($response_code);
    }

}