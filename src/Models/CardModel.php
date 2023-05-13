<?php

namespace App\Models;

class CardModel extends Model
{
    protected $fields = [
        'number',
        'holder_name',
        'exp_month',
        'exp_year',
        'cvv'
    ];
}
