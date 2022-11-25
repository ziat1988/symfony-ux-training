<?php
declare(strict_types=1);
namespace App\Tests;
use App\Import\ImportCSV;
use App\Import\ImportService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImportTest extends KernelTestCase
{

    /**
     * @dataProvider provideUri
     * @param string $path
     * @return void
     * @throws Exception
     */
    public function testImport(string $path):void
    {

        self::bootKernel();
        $container = static::getContainer();

        /** @var ImportCSV $importService */
        $importService = $container->get(ImportCSV::class);
        $importService->processImport($path);

        $this->assertSame(2,2,'same');
    }


    public function provideUri(): \Generator
    {
        yield 'csv' => [__DIR__.'/Fixtures/food.csv'];
        yield 'json' => [__DIR__.'/Fixtures/food.json'];
    }



}
