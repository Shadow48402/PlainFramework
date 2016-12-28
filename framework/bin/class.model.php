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
    protected $db;

    public function __construct()
    {
        $this->db = Database::getDB();
        $this->db_prefix = $this->db->getPrefix();
    }
}