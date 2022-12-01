<?php

namespace App\Command;

use App\Entity\FirstNameStat;
use App\Entity\Food;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;
use Symfony\Component\Stopwatch\Stopwatch;

#[AsCommand(
    name: 'app:import-food',
    description: 'Add a short description for your command',
)]
class ImportFoodCommand extends Command
{
    public function __construct(readonly private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('import');
        $io = new SymfonyStyle($input, $output);
        $io->title('Import starting...');

        $csv = Reader::createFromPath('shared/nat2018.csv', 'r');
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);
        $io->progressStart(count($csv));
        $batchSize = 100;
        foreach ($csv as $i=> $data) {

            $newFirstName = new FirstNameStat(
                $data["sexe"],
                $data["preusuel"],
                $data["annais"] === "XXXX" ? null: $data["annais"],
                $data["nombre"]);

            $this->em->persist($newFirstName);

            if (0 === $i % $batchSize && $i > 0){
                $this->em->flush();
                $this->em->clear();
            }

           // $newFood = new Food($data["food_name"],$data["scientific_name"],$data["group"]);
            //$this->em->persist($newFood);
            $io->progressAdvance();
        }

        $this->em->flush();
        $this->em->clear();

        $io->success('import success');

        $event = $stopwatch->stop('import');
        dump($event->getDuration());
        dump($event->getMemory());

        return Command::SUCCESS;
    }
}
