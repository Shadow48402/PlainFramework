<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: class.controller.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 19:40
 **/
abstract class Controller
{
    protected   $form,
                $load;

    public function __construct()
    {
        $this->form = [];
        $this->form ['post'] = $_POST;
        $this->form ['get'] = $_GET;
        $this->load = new Loader();
    }
}