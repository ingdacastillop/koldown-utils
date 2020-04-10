<?php

namespace Koldown\Utils\Structs;

use Traversable;
use ArrayIterator;

use Koldown\Utils\Contracts\IHashMap;

class HashMap implements IHashMap {
    
    // Atributos de la clase EntityCollection
    
    /**
     *
     * @var array 
     */
    protected $data = array();
    
    // Métodos sobrescritos de la interfaz IHashMap

    public function isEmpty(): bool {
        return $this->size() === 0;
    }

    public function size(): int {
        return count(array_keys($this->data));
    }

    public function put($key, $value): void {
        $this->data[$key] = $value;
    }

    public function get($key) {
        return !$this->containsKey($key) ? null : $this->data[$key];
    }

    public function values(): array {
        return $this->data;
    }

    public function containsKey($key): bool {
        return array_key_exists($key, $this->data);
    }

    public function remove($key): void {
        if ($this->containsKey($key)) {
            unset($this->data[$key]); // Eliminando clave de Map
        }
    }
    
    public function clear(): void {
        $this->data = array();
    }

    public function count(): int {
        return $this->size();
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->data);
    }

    public function jsonSerialize() {
        return $this->data;
    }
}