<?php

/**
 *
 ************************************************
 *                 PlainFramework               *
 ************************************************
 *
 *   Created by Niels Hamelink
 *   File: class.query.php
 *   Website: www.nielsha.nl
 *   Created at: 17-11-2016 15:30
 **/
class Query
{
    protected $query;

    public function __construct()
    { $this->query = ''; }

    public function toString()
    { return $this->query; }

    public function select($table, $columns='*')
    {
        $this->query .= 'SELECT ';
        if(is_array($columns))
        {
            $first = true;
            foreach($columns as $column)
            {
                if($first) {
                    $this->query .= $column . ' ';
                    $first = false;
                } else
                    $this->query .= ',' . $column . ' ';
            }
        }
        else if(is_string($columns))
        {
            $this->query .= $columns . ' ';
        } else
            Application::throw_error('Query->select() does only support arrays as strings.');

        $this->query .= 'FROM ' . $table . ' ';

        return $this;
    }

    public function where($column, $operator='=', $value)
    {
        $this->query .= $column . $operator . Database::getPDO()->quote($value) . ' ';
    }

    public function whereAnd($column, $operator='=', $value)
    {
        $this->query .= 'AND ' . $column. $operator . Database::getPDO()->quote($value) . ' ';
    }

    public function whereOr($column, $operator='=', $value)
    {
        $this->query .= 'OR '. $column . $operator . Database::getPDO()->quote($value) . ' ';
    }

    public function insert($table, $columns, $values)
    {
        $this->query .= 'INSERT INTO '.$table.' ';

        $this->query .= '(';
        if(is_array($columns))
        {
            $first = true;
            foreach($columns as $column)
            {
                if($first)
                {
                    $this->query .= $column . ' ';
                    $first = false;
                } else
                    $this->query .= ',' . $column . ' ';
            }
        } else if(is_string($columns))
            $this->query .= $columns;
        else
            Application::throw_error('Query->insert() does only support arrays and strings.');

        $this->query .= ') VALUES (';
        if(is_array($values))
        {
            $first = true;
            foreach($values as $value)
            {
                if($first)
                {
                    $this->query .= Database::getPDO()->quote($value) . ' ';
                    $first = false;
                } else
                    $this->query .= ',' . Database::getPDO()->quote($value) . ' ';
            }
        }
        $this->query .= ') ';
    }

}