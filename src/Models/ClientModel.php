<?php

namespace App\Models;

use App\Models\Enums\Cliente\DocumentTypeEnum;
use App\Models\Enums\Cliente\TypeEnum;
use App\Models\Enums\Cliente\GenderEnum;

class ClientModel extends Model
{

    protected $fields = [
        'name',
        'type',
        'email',
        'cpf',
        'cnpj',
        'gender',
        'phones',
        'birthdate',
        'home_phone',
        'mobile_phone',
        'address'
    ];

    public function toArray()
    {
        $this->getDocument();

        return $this->attributes;
    }
    private function getDocument()
    {
        $this->attributes['document'] =  $this->attributes['cpf'] ?? $this->attributes['cnpj'];

        unset($this->attributes['cpf']);
        unset($this->attributes['cnpj']);
    }
}
