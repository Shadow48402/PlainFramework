<?php

/**
 * Created by PhpStorm.
 * User: Niels
 * Date: 22-12-2016
 * Time: 17:40
 */
class Language
{
    public static $language_code = null;

    public static function setLanguage($language_code)
    {
        self::$language_code = $language_code;
    }
}