<?php
/**
 * index.php created for PlainFramework
 * Made by Niels, at 1-2-2016
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

require_once('handlers/'.$path.'.php');