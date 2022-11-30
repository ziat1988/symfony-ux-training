<?php

namespace App\Import;

//use Doctrine\DBAL\Logging\Middleware;
use App\Entity\Food;
use Doctrine\ORM\EntityManagerInterface;

abstract class ImportCSVAbstract
{

    public function __construct(readonly private EntityManagerInterface $em){

    }
    public function handleImport(string $path, string $separator = ','):bool
    {

        // logic for CSV
        $handle = fopen($path,"r");
        if($handle === false){
            throw new \RuntimeException('no handler for this path');
        }

        $batchSize = 100;
        $lineNumber = 0;
        while(($data = fgetcsv($handle,1000,$separator)) !== false){
            if($lineNumber === 0){
                $lineNumber++;
                continue;
            }

            // abstract instantiate
            $newInstance = $this->instantiateNew($data);
            $this->em->persist($newInstance);

            if (0 === $lineNumber % $batchSize){
                $this->em->flush();
                $this->em->clear();
            }

            $lineNumber++;
        }
        $this->em->flush();
        $this->em->clear();

        fclose($handle);

        return true;

    }


    /**
     * @template T
     * @param class-string<T> $className
     * @return T
     */
    function instance(string $className){
        return new $className();
    }

    /**
     * @param array<int,string> $data
     * @return mixed
     */
    abstract function instantiateNew(array $data) :mixed;
}
