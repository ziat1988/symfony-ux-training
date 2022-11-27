<?php
namespace App\Import;
use App\Entity\Food;

interface ImportStrategyInterface
{
    /**
     * @param string $path
     * @return array<array-key,Food>
     */
    public function processImport(string $path): array;
    public function supports(string $path):bool;
}
