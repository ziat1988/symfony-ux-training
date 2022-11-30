<?php

namespace App\Tests\Benchmark;

use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

class ReadFileBench
{
    static string $path =  __DIR__.'/../Fixtures/shakespeare.txt';
    /**
     * @return array<int,string>
     */
    public function benchRead() : array
    {
       // $path = __DIR__.'/../Fixtures/shakespeare.txt';
        $lines = [];
        $handle = fopen(self::$path, "r");

        if($handle === false){
            throw new \RuntimeException('no handler for this path');
        }
        while(!feof($handle)) {
            $line = fgets($handle);
            if($line === false){
                continue;
            }
            $lines[] = trim($line);
        }

        fclose($handle);
        return $lines;
    }


    public function benchReadGenerator() : \Generator
    {
        $handle = fopen(self::$path, "r");

        if($handle === false){
            throw new \RuntimeException('no handler for this path');
        }
        while(!feof($handle)) {
            $line = fgets($handle);
            if($line === false){
                continue;
            }
            yield trim($line);
        }

        fclose($handle);
    }
}
