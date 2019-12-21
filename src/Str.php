<?php

namespace Koldown\Utils;

class Str {
    
    // Atributos de la clase Str
    
    /**
     *
     * @var Str
     */
    private static $instance;
    
    // Constructor de la clase Str
    
    private function __construct() {
        ;
    }
    
    // Métodos de la clase Str
    
    /**
     * 
     * @param string $word
     * @return string
     */
    public function snakeToCamelCase(string $word): string {
        return str_replace(" ", "", ucwords(str_replace(array("_", "-"), " ", $word)));
    }
    
    /**
     * 
     * @return Str
     */
    public static function getInstance(): Str {
        if (is_null(self::$instance)) {
            self::$instance = new Str();
        } // Instanciando clase
        
        return self::$instance; // Retornando instancia
    }
}