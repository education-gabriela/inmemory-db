<?php

namespace Gabidavila\DB;

/**
 * Class Storage
 * @package Gabidavila\DB
 */
class Storage
{
    private $data = [];

    public function __construct()
    {

    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function remove($key)
    {
        unset($this->data[$key]);
    }

    public function get($key)
    {
        if (!array_key_exists($key, $this->data)) {
            return 'NULL';
        }
        return $this->data[$key];
    }

    public function getAllData()
    {
        return $this->data;
    }

    public function countValues($value)
    {
        return array_count_values($this->data)[$value];
    }

    public function flush()
    {
        $this->data = [];
    }

    public function countKeys()
    {
        return count($this->data);
    }
}