<?php

namespace App\Validations;

interface HandlerInterface
{
    public function setNext($handler);
    public function execute($request);
}
