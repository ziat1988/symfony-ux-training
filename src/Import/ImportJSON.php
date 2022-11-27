<?php

namespace App\Import;

use App\Entity\Food;

class ImportJSON implements ImportStrategyInterface
{
    public function processImport(string $path): array
    {
        $food = new Food();
        $food->setName('food1');
        $food->setGroupPrimary('abc');
        $food->setScientificName('science');
        return [$food];
    }

    public function supports(string $path): bool
    {
        return 'json' === pathinfo($path, PATHINFO_EXTENSION);
    }
}
