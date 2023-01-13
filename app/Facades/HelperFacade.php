<?php

    namespace App\Facades;

    use Illuminate\Support\Facades\Facade;
    use Illuminate\Support\Str;

    class HelperFacade extends Facade
    {
        protected static function toUpperCase($value)
        {
            return strtoupper($value);
        }
    }
?>
