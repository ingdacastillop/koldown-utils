<?php

if (!function_exists("is_array_json")) {
    function is_array_json($array): bool {
        if (!is_array($array)) { 
            return false; // Objeto establecido no es un array
        } 
        
        $keys = array_keys($array); // Extrayendo claves 
        
        if ($keys == 0) { 
            return false; // Array no tiene claves definidas
        } 

        foreach ($keys as $key) {
            if (!is_int($key)) {
                return true; // Array contiene claves definidas
            }
        }

        return false; // Array es indexado, array tradicional
    }
}