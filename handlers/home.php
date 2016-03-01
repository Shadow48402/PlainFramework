<?php
/**
 * home.php created for PlainFramework
 * Made by Niels, at 29-2-2016
 */
$hello = 'This is a Hello World string!';

$view = new View('views/home.tpl');
$view->setTitle('Home');
$view->addKeywords('home, page');
$view->assign('hello', $hello);
$view->display();