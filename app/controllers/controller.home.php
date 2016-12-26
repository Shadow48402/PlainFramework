<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: controller.home.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 19:37
 **/
class HomeController extends Controller
{

    public function home()
    {
        $this->load->model('blog');
        $blog_items = $this->load->model_blog->getItems();

        $view = new View('home');
        $view->set('blog_items', $blog_items);
        $view->display();
    }

}