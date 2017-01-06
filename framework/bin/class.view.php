<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: class.view.php
 *   Website: www.nielsha.nl
 *   Created at: 15-11-2016 08:38
 **/
class View
{
    protected   $name,
                $variables,
                $template_name,
                $response_code;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set($name, $value, $escape=true)
    {
        if($escape)
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

        $this->variables[$name] = $value;
    }

    public function setTemplate($template_name)
    {
        $this->template_name = $template_name;
    }

    public function getTemplate()
    {
        return $this->template_name;
    }

    public function display()
    {
        global $app;

        header('Content-Type: text/html; charset=utf-8');

        $smarty = $app->getSmartyInit();
        $smarty->assign('view_name', $app->getConfig()['tpl']['views'] . $this->name . '.tpl');
        foreach($this->variables as $key => $value)
        {
            $smarty->assign($key, $value);
        }
        if(!isset($this->template_name))
            $smarty->display($app->getConfig()['tpl']['templates'] .
            $app->getConfig()['tpl']['default_template'] . '.tpl');
        else
            $smarty->display($app->getConfig()['tpl']['templates'] .
            $this->template_name);
    }

}