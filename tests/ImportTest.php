<?php declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

class ImportTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideUri
     * @param string $uri
     * @return void
     */
    public function testImport(string $uri):void
    {
        dump($uri);
        $this->assertSame(2,2,'same');
    }


    public function provideUri(): Generator
    {
        yield 'csv' => [__DIR__.'/Fixtures/food.csv'];
        yield 'json' => [__DIR__.'/Fixtures/users.json'];
    }



    /**
     * @dataProvider provideTrimData
     */
    public function testTrim($expectedResult, $input): void
    {
        dump($expectedResult);
        dump($input);
        self::assertSame($expectedResult, trim($input));
    }

    /**
     * @return string[][]
     */
    public function provideTrimData(): array
    {
        return [
            [
                'Hello World',
                ' Hello World',
            ],
            [
                'Hello World',
                " Hello World \n",
            ],
        ];
    }
}
