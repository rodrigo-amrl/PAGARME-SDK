<?php

namespace App\Builders;

interface ClientBuilderInterface
{
    public function addAddress(array $data): void;
    public function addPhones(array $data): void;
    public function newClient(array $data): void;
}
