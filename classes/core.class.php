<?php

/**
 * core.class.php created for PlainFramework
 * Made by Niels, at 1-2-2016
 */
class Core
{
    protected $setup = false;
    protected $config;
    protected $database;

    function __construct(){}

    public function loadFiles()
    {
        require_once('database.class.php');
        require_once('theme.class.php');
        require_once('view.class.php');

        require_once('configs/template.config.php');
        require_once('configs/database.config.php');
        require_once('configs/custom.config.php');

        require_once('libs/smarty/Smarty.class.php');

        $this->setup = true;
        $this->config = $_CONFIG;
    }

    public function setupMySQL()
    {
        if($this->setup)
        {
            $this->database = new Database($this->config['database']['dsn'],
                $this->config['database']['username'],
                $this->config['database']['password']);

            $this->connection = $this->database->getConnection();
        }
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function getConfig()
    {
        return $this->config;
    }
}