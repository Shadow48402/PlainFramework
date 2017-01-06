<?php

class Cache
{
    static protected $db_cache = [];

    public static function store($query, $response)
    {
        self::$db_cache [base64encode($query)] = $response;
    }

    public static function contains($query)
    {
        return in_array(base64encode($query));
    }

    public static function get($query)
    {
        return self::$db_cache[base64encode($query)];
    }
}