<?php

/**
 * Created by PhpStorm.
 * User: Niels
 * Date: 21-12-2016
 * Time: 11:11
 */
class Loader
{
    protected $models, $languages;

    public function model($model_name)
    {
        $model_path = 'app/models/model.' . strtolower($model_name) . '.php';
        $model_class = 'Model' . ucfirst($model_name);

        if(!file_exists($model_path))
            Application::throw_error('Model ' . strtolower($model_name) . '(' . $model_path . ') could not be loaded!');

        require_once($model_path);
        $this->models[strtolower($model_name)] = new $model_class();
    }

    public function language($language_name, View $view)
    {
        $language_path = 'app/languages/' . Language::getLanguage() . '/' . strtolower($language_name) . '.php';

        if(!file_exists($language_path))
            Application::throw_error('Model ' . strtolower($language_name) . ' could not be loaded!');

        $lang_array = include_once($language_path);
        foreach($lang_array as $lang_key => $lang)
        {
            $view->set('lang_' . $lang_key, $lang);
        }
    }

    public function __get($name)
    {
        $start_model = strtolower(substr( $name, 0, 6 )); //model_ = 6
        if($start_model == 'model_')
        {
            $model_name = str_ireplace('model_', '', $name);
            if(isset($this->models[$model_name]))
                return $this->models[$model_name];
            else
                Application::throw_error('Model ' . $model_name . ' does not exist!');
        }

        /*$start_language = strtolower(substr( $name, 0, 9 )); // language_ = 9
        if($start_language == 'language_')
        {
            $language_name = str_ireplace('language_', '', $name);
            if(in_array($language_name, $this->languages))
                return $this->languages[$language_name];
            else
                Application::throw_error('Language file ' . $language_name . ' does not exist!');
        }*/
    }

}