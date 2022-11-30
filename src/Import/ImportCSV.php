<?php
namespace App\Import;
use App\Entity\Food;
use Doctrine\ORM\EntityManagerInterface;

class ImportCSV implements ImportStrategyInterface
{

    public function __construct(readonly private EntityManagerInterface $em){

    }
    public function processImport(string $path): bool
    {
        //$sqlConnection = $this->em->getConnection();

        // Disable logger, because it leaks memory
        //$logger = $sqlConnection->getConfiguration()->getSQLLogger();
      //  $sqlConnection->getConfiguration()->setSQLLogger(null);

        $handle = fopen($path,"r");
        if($handle === false){
            throw new \RuntimeException('no handler for this path');
        }
        $firstLine = true;
        while(($data = fgetcsv($handle,1000,',')) !== false){
            if($firstLine){
                $firstLine = false;
                continue;
            }

            // abstract instantiate
            $food = new Food($data[0],$data[1],$data[2]);
            $this->em->persist($food);
            $this->em->flush();
        }


        fclose($handle);
        return true;

    }



    public function supports(string $path): bool
    {
        return 'csv' === pathinfo($path, PATHINFO_EXTENSION);
    }
}
