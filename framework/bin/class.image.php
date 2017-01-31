<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: class.database.php
 *   Website: www.nielsha.nl
 *   Created at: 14-11-2016 02:08
 **/
class Image
{
    protected   $image,
                $image_path,
                $image_name,
                $image_width,
                $image_height,
                $image_extension;

    public function __construct($image_path, $image_width, $image_height, $image_name='', $image_extension='.png')
    {
        global $app;

        $this->image = new \claviska\SimpleImage();

        if(!file_exists($image_path))
            Application::throw_error('The image ' . $image_path . ' does not exist!');

        $this->image_path = $image_path;
        $this->image_width = $image_width;
        $this->image_heigt = $image_height;
        $this->image_extension = $image_extension;

        if($image_name != '')
            $this->image_name = $image_name;
        else
            $this->image_name = pathinfo($image_path, PATHINFO_FILENAME);

        $cache_file = $app->getConfig()['tpl']['img_cache'];
        $cache_file .= $this->image_name;
        $cache_file .= '_' . $image_width . 'x' . $image_height;
        $cache_file .= $image_extension;

        if(file_exists($cache_file))
            return $cache_file;

        try
        {
            $this->image
                ->fromFile($image_path)
                ->resize($this->image_width, $this->image_height)
                ->toFile($cache_file, 'image/' . str_replace('.', '', $this->image_extension));
        } catch(Exception $ex)
        {
            Application::throw_error($ex->getMessage());
        }

        return $cache_file;
    }

}