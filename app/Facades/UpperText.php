<?php

    namespace App\Facades;

    class UpperText extends HelperFacade
    {
        public function upperText($text) {
            return strtoupper($text);
        }
    }
?>
