<?php
/**
 * index.php created for PlainFramework
 * Made by Niels, at 1-2-2016
 * @version 1.1
 * @author Niels Hamelink
 * @license MIT-license 2015-2016
 * @copyright Gyvex
 */
session_start();
setlocale(LC_ALL, 'en_US.UTF8');

require('classes/core.class.php');

$core = new Core();
$core->loadFiles();
$core->setupMySQL();
$config = $core->getConfig();

$theme = new Theme();
$theme->getSmartyInstance()->assign('config', $config);

if(empty($_GET['path']))
    $path = 'home';
else
    $path = $_GET['path'];

if(file_exists($config['template']['handler_dir'].'/'.$path.'.php'))
    require_once($config['template']['handler_dir'].'/'.$path.'.php');
else
    require_once($config['template']['handler_dir'].'/'.$config['template']['404handler'].'.php');