<?php

/**
 * theme.class.php created for PlainFramework
 * Made by Niels, at 1-2-2016
 */
class Theme
{
    protected $smarty;

    public function __construct()
    {
        global $_CONFIG;

        $this->smarty = new Smarty();
    }

    public function test()
    {
        $this->smarty->testInstall();
    }

    public function getSmartyInstance()
    {
        return $this->smarty;
    }
}