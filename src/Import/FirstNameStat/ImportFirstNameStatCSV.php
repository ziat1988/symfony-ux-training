<?php

namespace App\Import\FirstNameStat;

use App\Entity\FirstNameStat;
use App\Import\ImportCSVAbstract;
use Doctrine\ORM\Mapping\Entity;

class ImportFirstNameStatCSV extends ImportCSVAbstract
{

    /**
     * @param array{string,string,string,string} $data
     * @return FirstNameStat
     */
    function instantiateNew(array $data): FirstNameStat
    {
        [$gender, $firstName, $yearOfBirth, $count] = $data;

        if ('XXXX' === $yearOfBirth) {
            $yearOfBirth = null;
        }
        return new FirstNameStat(
            (int)$gender,
            $firstName,
            $yearOfBirth? (int)$yearOfBirth : null,
            (int)$count);
    }
}
