<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\PopularStar;

class ImportMoviesCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:import-movies';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addOption('auth', null, InputArgument::OPTIONAL, 'Argument description', null)
            ->addOption('token', null,  InputArgument::OPTIONAL, '', null)
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $movieService = $this->getContainer()->get('movie.api');
        $token = '';

        if ($input->getOption('auth', null)) {
            dump($movieService->authenticate()); exit;
        }
        if ($input->getOption('token', null)) {
            $token = $input->getOption('token');
            $movieService->createApiSession($token);
        }

        $movies  = [];
        $pages = 30;
        $batchSize = 20;
        $em = $this->getContainer()->get('doctrine')->getManager();

        for($i = 1; $i <= $pages; $i++) {
            sleep(0.5);
            $movies = array_merge($movieService->getMovies($i)["results"],$movies);
        }

        foreach($movies as $key => $movie) {
            $mov = new PopularStar;
            $mov->setName($movie["name"]);
            $mov->setPopularity($movie["popularity"]);

            $em->persist($mov);

            if($key % $batchSize == 0) {
                $em->flush();
            }
        }

        $em->flush();
        dump('Imported ' . \count($movies) . ' results');
        dump('done'); exit;
    }
}
