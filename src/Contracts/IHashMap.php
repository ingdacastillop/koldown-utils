<?php

namespace Koldown\Utils\Contracts;

use IteratorAggregate;
use Countable;
use JsonSerializable;

interface IHashMap extends IteratorAggregate, Countable, JsonSerializable {
    
    // Métodos de la interfaz IHashMap
    
    /**
     * 
     * @return bool
     */
    public function isEmpty(): bool;
    
    /**
     * 
     * @return int
     */
    public function size(): int;
    
    /**
     * 
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function put($key, $value): void;
    
    /**
     * 
     * @param mixed $key
     * @return bool
     */
    public function containsKey($key): bool;
    
    /**
     * 
     * @param mixed $key
     */
    public function get($key);
    
    /**
     * 
     * @return array
     */
    public function values(): array;
    
    /**
     * 
     * @param mixed $key
     * @return void
     */
    public function remove($key): void;
    
    /**
     * 
     * @return void
     */
    public function clear(): void;
}