<?php

namespace Koldown\Utils\Contracts;

use ArrayAccess;
use JsonSerializable;

interface IDataTransfer extends ArrayAccess, JsonSerializable {
    
    // Métodos de la interfaz IDataTransfer
    
    /**
     * 
     * @param mixed $data
     * @return bool
     */
    public function map($data): bool;

    /**
     * @return array
     */
    public function toArray(): array;
}