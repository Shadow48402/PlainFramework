<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: class.application.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 02:12
 **/
class Application
{
    protected $log, $_smarty, $_config, $_paths;
    protected static $config, $paths, $smarty;

    public function __construct()
    {
        $this->log = [];

        $this->load_config();
        $this->load_files();
        $this->setup_database();
        $this->setup_libs();
        $this->load_controllers();
        $this->load_paths();
    }

    /**
     * FILE HANDLING
     */
    public static function load_models($models)
    {
        if(isset($config)) {
            foreach ($models as $model) {
                $file = $config['dir']['model_prefix']
                    . $model . '.php';

                if (!file_exists($file))
                    self::throw_error('Could not load model "' . $model . '"');

                require($file);
            }
        }
    }

    public function load_files()
    {
        foreach(require('framework/configs/config_files.php') as $file)
        {
            try
            {
                if(! @include_once($file))
                    throw new Exception('The framework file ' . $file . ' could not be found!');
            } catch(Exception $e)
            {
                self::throw_error($e->getMessage());
            }
        }
    }

    /**
     * CONFIG HANDLING
     */
    public function load_config()
    {
        try
        {
            $this->_config = require('app/config.php');
            $config = require('app/config.php');

            if (!isset($this->_config) || !isset($config))
                throw new Exception('The config could not get loaded!');
        } catch(Exception $e)
        {
            self::throw_error($e->getMessage());
        }
    }

    public function getConfig()
    {
        if(!isset($this->_config)) $this->_config = [];
        return $this->_config;
    }

    /**
     * DATABASE HANDLING
     */
    public function setup_database()
    {
        $dsn = 'mysql:host=' . $this->_config['database']['host']
            . ';dbname=' . $this->_config['database']['database'];

        Database::connect(
            $dsn,
            $this->_config['database']['username'],
            $this->_config['database']['password'],
            $this->_config['database']['debug']
        );
    }

    /**
     * FRAMEWORK LIBS SETUP
     */
    public function setup_libs()
    {
        if($this->_config['tpl']['enabled'])
        {
            require_once($this->_config['tpl']['path']);
            $this->_smarty = new Smarty();

            $this->_smarty->setTemplateDir($this->_config['tpl']['templates']);
            $this->_smarty->setCompileDir($this->_config['tpl']['compile']);
            $this->_smarty->setConfigDir($this->_config['tpl']['configs']);
            $this->_smarty->setCacheDir($this->_config['tpl']['cache']);
            $this->_smarty->debugging = $this->_config['tpl']['debug'];
        }
    }

    public function getSmartyInit()
    {
        return $this->_smarty;
    }

    public static function getSmarty()
    {
        if(!isset($smarty)) return null;
        return $smarty;
    }

    /**
     * PATH HANDLING
     */
    public function load_paths()
    {
        try
        {
            $this->_paths = require('app/paths.php');
            $paths = $this->_paths;

            if(!isset($this->_paths))
                throw new Exception('There is no pathing found in your application!');
        } catch(Exception $e)
        {
            self::throw_error($e->getMessage());
        }
    }

    public function load_path()
    {
        if($this->_config['general']['path'] == null)
            $path = '/';
        else
            $path = $this->_config['general']['path'];

        if(in_array($path, array_keys($this->_paths)))
        {
            $parts = explode('@', $this->_paths[$path]);

            $controller = $parts[0];
            $function = $parts[1];

            $controller = new $controller;
            $controller->$function();
            return;
        } else
        {
            foreach($this->_paths as $route => $execute)
            {
                $splitDefined = explode('/', $route);
                $splitCurrent = explode('/', $path);
                $args = [];
                for($i = 0; $i < count($splitDefined); $i++)
                {
                    $pattern = '/\$+[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/';
                    $found = false;
                    if(preg_match($pattern, $splitDefined[$i], $match)
                    && !empty($splitCurrent[$i]))
                    {
                        $args[substr($match[0], 1)] = $splitCurrent[$i];
                        $found = true;
                    }

                    if($splitDefined[$i] == $splitCurrent[$i])
                        $found = true;

                    if($found == true)
                    {
                        if($i == (count($splitDefined)-1))
                        {
                            $parts = explode('@', $execute);

                            $controller = $parts[0];
                            $function = $parts[1];

                            $controller = new $controller;
                            if(count($args) > 0)
                                $controller->$function($args);
                            else
                                $controller->$function();

                            return;
                        }
                    } else
                        break;
                }
            }
        }

    }

    public static function getPaths()
    {
        if(!isset($paths)) $paths = [];
        return $paths;
    }

    /**
     * CONTROLLER HANDLING
     */
    public function load_controllers()
    {
        $controller_dir = 'app/' . $this->_config['dir']['controllers'];
        $dir_files = scandir($controller_dir);

        for($i = 2; $i < count($dir_files); $i++)
        {
            $dir_file = $dir_files[$i];

            try
            {
                if (!(include_once($controller_dir . '/' . $dir_file)))
                    throw new Exception('The controller ' . $dir_file . ' could not get loaded!');
            } catch (Exception $e)
            {
                self::throw_error($e->getMessage());
            }
        }
    }

    public function send_error($error)
    {
        $view = new View($this->_config['errors'][$error]);
        $view->display();
    }

    /**
     * LOG HANDLING
     */
    public static function throw_error($error)
    {
        die('PlainFramework crashed: '.$error);
    }

    public function addLog($log)
    {
        $this->log [] = $log;
    }

    public function throwLogs()
    {
        foreach($this->log as $log)
        {
            echo "- $log\n";
        }
    }

}