<?php

namespace App\Validations;

class Validator implements HandlerInterface
{


    private $next;


    function setNext($handler)
    {
        $this->next = $handler;
    }


    function execute($request)
    {


        //Implementation logic goes here


        echo "Validating inputs\n";


        //If next handler is defined. The request is left hanging if next handler is not defined.
        if ($this->next) {
            $this->next->execute($request);
        }
    }
}
