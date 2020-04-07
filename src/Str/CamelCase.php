<?php

namespace Koldown\Utils\Str;

class CamelCase {
    
    // Métodos de la clase CamelCase
    
    /**
     * 
     * @param string $strSnake
     * @return string
     */
    public function setter(string $strSnake): string {
        return "set{$this->ofSnake($strSnake)}";
    }
    
    /**
     * 
     * @param string $strSnake
     * @return string
     */
    public function getter(string $strSnake): string {
        return "get{$this->ofSnake($strSnake)}";
    }
    
    /**
     * 
     * @param string $strSnake
     * @return string
     */
    public function ister(string $strSnake): string {
        return "is{$this->ofSnake($strSnake)}";
    }

    /**
     * 
     * @param string $strSnake
     * @return string
     */
    public function ofSnake(string $strSnake): string {
        return str_replace(" ", "", ucwords(str_replace(array("_", "-"), " ", $strSnake)));
    }
}