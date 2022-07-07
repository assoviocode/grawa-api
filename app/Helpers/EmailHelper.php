<?php
namespace App\Helpers;

class EmailHelper
{

    public static function obfuscateEmail(string $email)
    {
        return substr_replace($email, '*****', 1, strpos($email, '@') - 3);
    }
}

