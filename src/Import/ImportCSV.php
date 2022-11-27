<?php
namespace App\Import;
use App\Entity\Food;

class ImportCSV implements ImportStrategyInterface
{
    public function processImport(string $path): array
    {
        $food = new Food();
        $food->setName('food2');
        $food->setGroupPrimary('abc');
        $food->setScientificName('science');
        return [$food];
    }

    public function supports(string $path): bool
    {
        return 'csv' === pathinfo($path, PATHINFO_EXTENSION);
    }
}
