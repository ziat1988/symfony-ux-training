<?php

namespace App\Import\Food;

use App\Entity\Food;
use App\Import\ImportCSVAbstract;

class ImportFoodCSV extends ImportCSVAbstract
{

    /**
     * @param array{string,string,string} $data
     * @return Food
     */
    public function instantiateNew(array $data) : Food
    {
        // TODO: Implement instantiateNew() method.
        return new Food($data[0],$data[1],$data[2]);
    }
}
