<?php

namespace App\Tests\Benchmark;

use App\Import\ImportCSV;
use App\Import\ImportsHandler;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImportConsumerBench extends KernelTestCase
{
    public function benchConsume():void
    {

        self::bootKernel();
        $container = static::getContainer();

        die('gi');
        /** @var ImportsHandler $importHanlder */
        $importHanlder = $container->get(ImportsHandler::class);

        dd($importHanlder);

        /*
        $res = $importHanlder->execute($path);
        $consumer = new ImportsHandler([new ImportCSV()]);
        $path = __DIR__.'/../Fixtures/generic-food.csv';
        $consumer->execute($path);
        */

    }

}
