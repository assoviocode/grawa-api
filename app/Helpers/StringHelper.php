<?php
namespace App\Helpers;

use Illuminate\Validation\ValidationException;

class StringHelper
{

    public static function removeCaracteres($value)
    {
        if(is_null($value)){
           throw new ValidationException("Parâmetro inválido!");
        }
        
        return preg_replace('/[^0-9]/', '', $value);
    }
}

