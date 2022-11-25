<?php
namespace App\Import;

interface ImportStrategyInterface
{
    public function processImport(string $path):void;
}
