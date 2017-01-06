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

    public static function connect($dsn, $username, $password, $encoding, $debug, $prefix)
    {
        try
        {
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            );

            if(!empty($encoding))
            {
                if( version_compare(PHP_VERSION, '5.3.6', '<') ){
                    if( defined('PDO::MYSQL_ATTR_INIT_COMMAND') ){
                        $options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES ' . $encoding;
                    }
                }else{
                    $dsn .= ';charset=' . $encoding;
                }
            }
            self::$_db = new PDO($dsn, $username, $password);
            self::$_prefix = $prefix;

            if( version_compare(PHP_VERSION, '5.3.6', '<') && !defined('PDO::MYSQL_ATTR_INIT_COMMAND') ){
                $encoding = (!empty($encoding)) ? $encoding : 'utf8';
                self::$_db->exec('SET NAMES ' . $encoding);
            }
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
        $plainquery = $query;
        foreach($values as $key => $val)
        {
            $plainquery = str_ireplace($key, $val, $plainquery);
        }

        if(Cache::contains($plainquery))
            return Cache::get($plainquery);

        $query = $this->_db->prepare($query);
        $query->execute($values);
        Cache::store($plainquery, $query);

        return $query;
    }

    public function query($query)
    {
        if(Cache::contains($query))
            return Cache::get($query);

        $exec = $this->_db->query($query);
        Cache::store($query, $exec);

        return $exec;
    }

    public function quote($string)
    {
        $this->_db->quote($string);
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