<?php

namespace App\Models;

class PhoneModel
{

    public function __construct(
        protected Int $country_code,
        protected Int $are_code,
        protected Int $number
    ) {
    }
}
