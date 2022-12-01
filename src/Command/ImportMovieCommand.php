<?php

namespace App\Command;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Exception;
use League\Csv\InvalidArgument;
use League\Csv\Reader;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Stopwatch\Stopwatch;
use function PHPUnit\Framework\throwException;

#[AsCommand(
    name: 'app:import-movie',
    description: 'Add a short description for your command',
)]
class ImportMovieCommand extends Command
{

    public function __construct(readonly private Stopwatch $stopwatch, readonly private EntityManagerInterface $em)
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Doctrine\DBAL\Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $sqlConnection = $this->em->getConnection();
        $this->stopwatch->start('import');
        try{
            $sqlConnection->beginTransaction();
            $this->insert($input,$output);
            $sqlConnection->commit();

        }catch (\Exception $e){
            dump($e->getMessage());
            dump($e->getTrace());
            $sqlConnection->rollBack();
            throwException($e);
        }


        $event = $this->stopwatch->stop('import');
        dump($event->getDuration());
        dump($event->getMemory());
        return Command::SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws Exception
     * @throws InvalidArgument
     */
    private function insert(InputInterface $input, OutputInterface $output):void
    {
        $csv = Reader::createFromPath('shared/movies.csv', 'r');
        $csv->setDelimiter(',');
        $csv->setHeaderOffset(0);

        $batchSize = 100;
        $io = new SymfonyStyle($input, $output);
        $io->title('Import starting...');
        $io->progressStart(count($csv));

        foreach ($csv as $i=> $data) {
            $movie = new Movie(
                $data["title"],
                $data["genres"],
                $data["original_language"],
                $data["overview"]?:null,
                $data["popularity"]?:null,
                $data["vote_average"]?: null,
                $data["vote_count"]?:null

            );

            $this->em->persist($movie);

            if (0 === $i % $batchSize && $i > 0){
                $this->em->flush();
                $this->em->clear();
            }


            $io->progressAdvance();
        }

        $this->em->flush();
        $this->em->clear();
        $io->success('import success');
    }
}
