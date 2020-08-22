<?php

namespace App\ApiExceptions;

class ApiException extends \Exception
{
    public function __construct($message,$code = 100){
        parent::__construct($message,$code);
    }
}
