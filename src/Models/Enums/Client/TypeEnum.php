<?php

namespace App\Models\Enums\Cliente;


enum TypeEnum: String
{
    case pf = "Pessoa Física";
    case pj = "Pessoa Jurídica";
}
