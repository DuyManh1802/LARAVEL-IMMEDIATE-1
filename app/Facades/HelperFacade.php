<?php

    namespace App\Facades;

    use Illuminate\Support\Facades\Facade;
    use Illuminate\Support\Str;

    class HelperFacade extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return 'UpperText';
        }
    }
?>