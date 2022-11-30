<?php

namespace App\Import;

use App\Entity\Food;

class ImportJSON implements ImportStrategyInterface
{
    /**
     * @param string $path
     * @return bool
     */
    public function processImport(string $path):bool
    {
        return false;
    }

    public function supports(string $path): bool
    {
        return 'json' === pathinfo($path, PATHINFO_EXTENSION);
    }
}
