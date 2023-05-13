<?php

namespace App\Models\Enums\Cliente;


enum DocumentTypeEnum: String
{
    case cpf = "CPF";
    case cnpj = "CNPJ";
    case passport = "Passaporte";
}
