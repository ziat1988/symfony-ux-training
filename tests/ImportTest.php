<?php
declare(strict_types=1);
namespace App\Tests;
use App\Import\FirstNameStat\ImportFirstNameStatCSV;
use App\Import\Food\ImportFoodCSV;
use App\Import\ImportCSV;
use App\Import\ImportService;
use App\Import\ImportsHandler;
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
        self::bootKernel([
            'debug'=>false
        ]);
        $container = static::getContainer();

        /** @var ImportFirstNameStatCSV $importCSV */
        $importCSV = $container->get(ImportFirstNameStatCSV::class);
        $res= $importCSV->handleImport($path,';');

//        /** @var ImportFoodCSV $importCSV */
//        $importCSV = $container->get(ImportFoodCSV::class);
//        $res=$importCSV->handleImport($path);

//        /** @var ImportsHandler $importHanlder */
//        $importHanlder = $container->get(ImportsHandler::class);
//        $res = $importHanlder->execute($path);

        self::assertSame(true,$res,'same');

    }


    public function provideUri(): \Generator
    {
        yield 'csv' => [__DIR__.'/Fixtures/nat2018.csv'];
       // yield 'csv' => [__DIR__.'/Fixtures/generic-food.csv'];
      //  yield 'json' => [__DIR__.'/Fixtures/food.json'];
    }



}
