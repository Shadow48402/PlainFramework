<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: model.Model.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 08:25
 **/
abstract class Model
{
    protected $_db;

    public function __construct()
    {
        $this->_db = Database::getDB();
    }
}