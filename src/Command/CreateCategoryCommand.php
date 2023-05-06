<?php

namespace App\Command;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-category',
    description: 'Add a short description for your command',
)]
class CreateCategoryCommand extends Command
{
	private $entityManager ;
	public function __construct(EntityManagerInterface $entityManager)
	{
		parent::__construct();

		$this->entityManager = $entityManager ;
	}


	protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       // TODO : example 1
        $data = [
			['intitule'=> 'Poussins', 'categorieAge'=>'10-11'],
			['intitule'=> 'Benjamins', 'categorieAge'=>'12-13'],
            ['intitule'=> 'Minimes', 'categorieAge'=>'14-15'],
            ['intitule'=> 'Cadets', 'categorieAge'=>'16-17'],
            ['intitule'=> 'TC', 'categorieAge'=>'18+'],
		];
       




        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }
		
        // TODO : example 2

		$counter = 0;
		foreach ($data as $item){
			$counter++;
			$categorie = new Categorie() ;
			$categorie->setIntitule($item['intitule']);
			$categorie->setCategorieAge($item['categorieAge']);
			$categorie->setPosition(1);
			$this->entityManager->persist($categorie);
			$io->info($item['intitule'].' as persisted');

			if ($counter == 5){
				$this->entityManager->flush();
				$this->entityManager->clear();
				$counter = 0;
				$io->success('last 5 items as created !');
			}
		}
        $io->success('all items created successfully !');

        return Command::SUCCESS;
    }
}
