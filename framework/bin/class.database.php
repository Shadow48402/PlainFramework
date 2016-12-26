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
    static protected $_db;

    public static function connect($dsn, $username, $password, $debug)
    {
        try
        {
            self::$_db = new PDO($dsn, $username, $password);
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
        return isset(self::$_db)
            && self::$_db != null;
    }

    public static function getDB()
    {
        if(!isset(self::$_db))
            return null;

        return self::$_db;
    }

    /*public static function preparedStatement($query, $values=[])
    {
        $query = self::$_db->prepare($query);
        $query->execute($values);

        return $query;
    }

    public static function executeQuery(Query $query)
    {
        try
        {
            return self::$_db->query($query->toString());
        } catch(PDOException $ex)
        {
            Application::throw_error($ex->getMessage());
        }
    }*/

}