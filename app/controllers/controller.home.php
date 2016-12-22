<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: controller.home.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 19:37
 **/
class HomeController extends Controller
{

    public function home()
    {
        $view = new View('home');
        $view->display();
    }

    public function test()
    {
        $view = new View('test');
        $view->display();
    }

    public function testpath($args=[])
    {
        print_r($args);
    }

}