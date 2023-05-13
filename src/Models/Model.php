<?php

namespace App\Models;

abstract class Model
{

    protected $fields = [];

    protected $attributes = [];

    public function __construct(array $Arrayfields = null)
    {
        $this->addFields($Arrayfields);
    }
    private function addFields($array)
    {
        if (empty($array)) return;


        foreach ($array as $field => $value) {

            if ($this->fieldExist($field))
                $this->attributes[$field] = $value;
        }
    }
    public function addOneToOne(String $field, Model $data)
    {
        if ($this->fieldExist($field))
            $this->attributes[$field] = $data->toArray();
    }
    public function addOneToMany(String $field, Model $data)
    {
        if ($this->fieldExist($field))
            $this->attributes[$field][]  = $data->toArray();
    }
    private function fieldExist($field)
    {
        return in_array($field, $this->fields);
    }
    public function toArray()
    {
        return $this->attributes;
    }
}
