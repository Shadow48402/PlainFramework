<?php

/**
 * database.class.php created for PlainFramework
 * Made by Niels, at 1-2-2016
 */
class Database
{
    protected $database;

    /**
     * Database constructor, setting up the connection
     * @param $dsn
     * @param $username
     * @param $password
     */
    public function __construct($dsn, $username, $password)
    {
        try {
            $this->database = new PDO($dsn, $username, $password);
        } catch(PDOException $e) {
            die($e);
        }
    }

    /**
     * Setting the value of the connection to null
     */
    public function stopConnection()
    {
        $this->database = null;
    }

    /**
     * Getting the connection
     * @return PDO
     */
    public function getConnection()
    {
        return $this->database;
    }

}