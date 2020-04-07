<?php

namespace Koldown\Utils;

use Koldown\Utils\Str\CamelCase;

class Str {
    
    // Atributos de la clase Str
    
    /**
     *
     * @var Str
     */
    private static $instance;
    
    /**
     *
     * @var CamelCase 
     */
    private $camelCase;

    // Constructor de la clase Str
    
    private function __construct() {
        ;
    }
    
    // Métodos de la clase Str
    
    /**
     * 
     * @return CamelCase
     */
    public function getCamelCase(): CamelCase {
        if (is_null($this->camelCase)) {
            $this->camelCase = new CamelCase(); // Instanciando CamelCase
        } 
        
        return $this->camelCase; // Retornando CamelCase
    }

    /**
     * 
     * @return Str
     */
    public static function getInstance(): Str {
        if (is_null(self::$instance)) {
            self::$instance = new static(); // Instanciando Str
        } 
        
        return self::$instance; // Retornando instancia
    }
}