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

}