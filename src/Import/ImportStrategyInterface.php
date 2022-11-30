<?php
namespace App\Import;
use App\Entity\Food;

interface ImportStrategyInterface
{
    /**
     * @param string $path
     */
    public function processImport(string $path): bool;
    public function supports(string $path):bool;
}
