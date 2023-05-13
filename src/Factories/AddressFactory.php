<?php

namespace App\Factories;

use App\Models\AdressModel;
use App\Validations\Validator;

class AdressFactory implements FactoryInterface
{

    public static function create(array $data)
    {
        return new AdressModel($data);
    }
}
