<?php

namespace App\Import;

use App\Entity\Food;

class ImportsHandler
{
    /**
     * @param array<int,ImportStrategyInterface> $importsHandler
     */
    public function __construct(private readonly iterable $importsHandler)
    {
    }

    /**
     * @param string $path
     * @return array<array-key,Food>
     */
    public function execute(string $path) : array
    {
        foreach ($this->importsHandler as $importHandler){
            if($importHandler->supports($path)){
                return $importHandler->processImport($path);
            }
        }

        throw new \RuntimeException('no service import for path');
    }
}
