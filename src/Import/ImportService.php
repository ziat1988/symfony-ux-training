<?php
namespace App\Import;
class ImportService
{
    public function __construct(private ImportStrategyInterface $strategy){
    }

    public function import(string $path): void
    {
        $this->strategy->processImport($path);
    }

}
