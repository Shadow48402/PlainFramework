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
    static protected    $_db,
        $_prefix;

    public static function connect($dsn, $username, $password, $debug, $prefix)
    {
        try
        {
            self::$_db = new PDO($dsn, $username, $password);
            self::$_prefix = $prefix;
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

    public static function setPrefix($prefix)
    {
        self::$_prefix = $prefix;
    }

    public static function getPrefix()
    {
        return self::$_prefix;
    }

    public static function getDB()
    {
        if(!isset(self::$_db))
            return null;

        return new DatabaseObject(self::$_db, self::$_prefix);
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

class DatabaseObject {
    protected   $_db,
        $_prefix;

    public function __construct($_db, $_prefix)
    {
        $this->_db = $_db;
        $this->_prefix = $_prefix;
    }

    public function preparedStatement($query, $values=[])
    {
        $query = $this->_db->prepare($query);
        $query->execute($values);

        return $query;
    }

    public function getPrefix()
    {
        return $this->_prefix;
    }

    public function lastId()
    {
        return $this->_db->lastInsertId();
    }

}