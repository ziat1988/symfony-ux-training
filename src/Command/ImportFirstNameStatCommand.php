<?php

namespace App\Command;

use App\Import\FirstNameStat\ImportFirstNameStatCSV;
//use App\Import\Food\ImportFoodCSV;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Stopwatch\Stopwatch;

#[AsCommand(
    name: 'app:import-name',
    description: 'import csv to bdd',
)]
class ImportFirstNameStatCommand extends Command
{
    public function __construct(private readonly ImportFirstNameStatCSV $importService)
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

/*
    private function coutLine(string $path):int
    {
        $file = new \SplFileObject($path, 'r');

        $file->seek(PHP_INT_MAX);
        return $file->key(); // substract head
    }
    */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('eventImport');

        $path = 'shared/nat2018.csv';
        $io = new SymfonyStyle($input, $output);
        $io->title('Import starting...');

        $this->importService->handleImport($path,';');

        $io->success('import success');

        $event = $stopwatch->stop('eventImport');
        dump($event->getDuration());
        dump($event->getMemory());
        return Command::SUCCESS;
    }
}
