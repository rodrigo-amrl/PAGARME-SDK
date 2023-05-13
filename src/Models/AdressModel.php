<?php

namespace App\Models;

class AdressModel extends Model
{
    protected $fields = [
        'country',
        'state',
        'city',
        'zip_code',
        'street',
        'street_number',
        'neighborhood'
    ];

    protected $fields_street = [
        'street',
        'street_number',
        'neighborhood'
    ];

    public function toArray()
    {
        $this->attributes['line_1'] = $this->getLine1();
        $this->attributes['line_2'] = '';

        return $this->attributes;
    }
    private function getLine1()
    {
        $line_1 = [];
        foreach ($this->fields_street as $field_street) {
            if (isset($this->attributes[$field_street])) {
                $line_1[] = $this->attributes[$field_street];
                unset($this->attributes[$field_street]);
            }
        }
        return implode(',', $line_1);
    }
}
