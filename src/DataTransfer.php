<?php

namespace Koldown\Utils;

use Koldown\Utils\Contracts\IDataTransfer;

class DataTransfer implements IDataTransfer {
    
    // Atributos de la clase DataTransfer

    /**
     *
     * @var array 
     */
    private $data = [];
    
    // Constructor de la clase DataTransfer
    
    public function __construct($data = null) {
        if (!is_null($data)) {
            $this->map($data); // Mapeando datos
        }
    }
    
    // Métodos de la clase DataTransfer
    
    /**
     * 
     * @param array $data
     * @return array
     */
    public static function convertArray(array $data): array {
        $array = []; // Formato tradicional de PHP
        
        foreach ($data as $item) {
            array_push($array, (is_array_json($item)) ? new static($item) : $item);
        } // Cargando items en el array
        
        return $array; // Retornando datos en array
    }

    // Métodos mágicos sobrescritos de PHP
    
    public function &__get($key) {
        return $this->data[$key];
    }
    
    public function __set($key, $value) {
        $this->data[$key] = $value;
    }
    
    public function __isset($key) {
        return isset($this->data[$key]);
    }
    
    public function __unset($key) {
        unset($this->data[$key]);
    }
    
    public function __toString() {
        return json_encode($this->jsonSerialize());
    }
    
    // Métodos sobrescritos de la interfaz ArrayAccess
    
    public function offsetExists($offset): bool {
        return isset($this->data[$offset]);
    }
    
    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }
    
    public function offsetSet($offset, $value): void {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }
    
    public function offsetUnset($offset): void {
        if ($this->offsetExists($offset)) { 
            unset($this->data[$offset]); // Array
        }
    }
    
    // Métodos sobrescritos de la interfaz JsonSerializable
    
    public function jsonSerialize() {
        $json = []; // JSON para serialización de objeto
        
        foreach (array_keys($this->data) as $key) {
            $value = $this->data[$key]; // Valor de clave
            
            if ($value instanceof IJson) {
                $json[$key] = $value->toArray();
            } else if (is_array($value)) {
                $json[$key] = $this->jsonToArray($value);
            } else {
                $json[$key] = $value; // Es un dato generico
            }
        }
        
        return $json; // Datos en formato JSON serializado
    }
    
    // Métodos sobrescritos de la interfaz IDataTransfer

    public function map($data): bool {
        if (!is_array_json($data)) {
            return false; // No se puede mapear objeto
        }
        
        foreach (array_keys($data) as $key) {
            if (is_array($data[$key])) {
                $this->mapArrayJson($key, $data[$key]);
            } else {
                $this[$key] = $data[$key];
            }
        }
        
        return true; // Mapeo de los datos en el objeto
    }

    public function toArray(): array {      
        return $this->jsonSerialize(); // Retornando objeto como Array
    }
    
    // Métodos operacionales de la clase DataTransfer

    /**
     * 
     * @param string $key
     * @param mixed $array
     * @return void
     */
    private function mapArrayJson(string $key, $array): void {
        if (is_array_json($array)) {
            $this[$key] = new DataTransfer($array); // Array JSON
        } else {
            $array_new = []; // Array indexado
            
            foreach ($array as $item) {
                array_push($array_new, $this->mapItem($item));
            }
            
            $this[$key] = $array_new; // Asignando datos generado
        }
    }
    
    /**
     * 
     * @param mixed $item
     * @return mixed
     */
    private function mapItem($item) {
        return (is_array($item)) ? new DataTransfer($item) : $item;
    }
    
    /**
     * 
     * @param array $data
     * @return array
     */
    private function jsonToArray(array $data): array {
        $array = []; // Formato tradicional de PHP
        
        foreach ($data as $item) {
            array_push($array, ($item instanceof IDataTransfer) ? $item->toArray() : $item);
        } // Cargando objetos en el array
        
        return $array; // Retornando datos del array
    }
}