<?php
namespace App\Import;
class ImportService
{
    public function __construct(private ImportStrategyInterface $strategy){
    }

    public function setStrategy(ImportStrategyInterface $strategy) :void
    {
        $this->strategy= $strategy;
    }
    public function import(string $path): void
    {
        $this->strategy->processImport($path);
    }

}
