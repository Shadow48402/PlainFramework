<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: class.database.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 02:08
 **/
class Database
{
    private static $_db;

    public static function connect($dsn, $username, $password, $debug)
    {
        try
        {
            $_db = new PDO($dsn, $username, $password);
        } catch(PDOException $e)
        {
            if($debug)
                Application::throw_error($e->getMessage());
        }
    }

    public static function close()
    {
        $_db = null;
    }

    public static function isConnected()
    {
        return isset($_db)
            && $_db != null;
    }

    public static function getPDO()
    {
        if(!isset($_db))
            $_db = null;

        return $_db;
    }

    public static function executeQuery(Query $query)
    {
        try
        {
            return Database::getPDO()->query($query->toString());
        } catch(PDOException $ex)
        {
            Application::throw_error($ex->getMessage());
        }
    }

}