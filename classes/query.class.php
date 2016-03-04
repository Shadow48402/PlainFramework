<?php

/**
 * query.class.php created for PlainFramework
 * Made by Niels, at 3-3-2016
 */
class Query
{
    protected $query;

    public function __construct(){ $this->query = ''; }

    public function toString()
    {
        return $this->query;
    }

    public function select($fields='*')
    {
        $this->query .= 'SELECT '.$fields.' ';

        return $this;
    }

    public function insert($table)
    {
        $this->query .= 'INSERT INTO '.$table.' ';

        return $this;
    }

    public function update($table, $columns='')
    {
        $this->query .= 'UPDATE '.$table.' ';
        if(!empty($columns))
        {
            if(is_array($columns))
            {
                for($i = 0; $i < count($columns); $i++)
                {
                    $this->query .= $columns[$i];
                    if($i != count($columns)-1)
                        $this->query .= ', ';
                }
            }
            else
                $this->query .= '('.$columns.')';
        }

        return $this;
    }

    public function from($table)
    {
        $this->query .= 'FROM '.$table.' ';

        return $this;
    }

    public function values($fields)
    {
        if(is_array($fields))
        {
            for($i = 0; $i < count($fields); $i++)
            {
                $this->query .= $fields[$i];
                if($i != count($fields)-1)
                    $this->query .= ', ';
            }
        } else
            $this->query .= 'VALUES ('.$fields.') ';

        return $this;
    }

    public function set($column, $value)
    {
        $this->query .= $column.'='.$value.' ';

        return $this;
    }

    public function where($column, $value, $operator='=')
    {
        $this->query .= 'WHERE '.$column.$operator.$value.' ';

        return $this;
    }

    public function whereOr($column, $value, $operator)
    {
        $this->query .= 'OR '.$column.$operator.$value.' ';

        return $this;
    }

    public function whereAnd($column, $value, $operator)
    {
        $this->query .= 'AND '.$column.$operator.$value.' ';

        return $this;
    }

    public function distinct($fields='*')
    {
        $this->query .= 'SELECT DISTINCT '.$fields.' ';

        return $this;
    }

    public function orderBy($column, $type='ASC')
    {
        $this->query .= 'ORDER BY '.$column.' '.$type.' ';

        return $this;
    }

    public function delete($columns='')
    {
        if(empty($columns))
            $this->query .= 'DELETE ';
        else
            $this->query .= 'DELETE '.$columns.' ';

        return $this;
    }

    public function drop($object, $value)
    {
        $this->query .= 'DROP '.$object.' '.$value;

        return $this;
    }
}