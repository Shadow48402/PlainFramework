<?php

/**
 * view.class.php created for PlainFramework
 * Made by Niels, at 1-2-2016
 */
class View
{
    protected $path;

    /**
     * View constructor.
     * @param string $path
     */
    public function __construct($path='')
    {
        global $_CONFIG;
        $this->path = $_CONFIG['template']['views_dir'].$path;
    }

    /**
     * Assigning variables into the TPL engine
     * @param $key
     * @param $value
     */
    public function assign($key, $value)
    {
        global $theme;

        $theme->getSmartyInstance()->assign($key, $value);
    }

    /**
     * Adding a title to the head of the TPL template file
     * @param $title
     */
    public function setTitle($title)
    {
        $this->assign('title', $title);
    }

    /**
     * Adding keywords to the head of the TPL template file
     * @param $keywords
     */
    public function addKeywords($keywords)
    {
        $this->assign('keywords', $keywords);
    }

    /**
     * Displaying the view file into the template
     */
    public function display()
    {
        global $theme;

        $this->assign('view_name', $this->path);
        $theme->getSmartyInstance()->display('template.tpl');
    }
}