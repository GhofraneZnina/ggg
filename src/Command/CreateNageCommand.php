<?php

namespace App\Command;

use App\Entity\Nage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-nage',
    description: 'Add a short description for your command',
)]
class CreateNageCommand extends Command
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
       
       // TODO : example 3
		$metrage = ['50','100','200','400','800','1500','4*100','4*50','4*200','4*400','4*800','4*1500','10*50','10*100','10*200','10*400','10*800','10*1500'];
		$types = ['crawl','pap','nl','dos','br','n','nl mix'];






        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }
		
        // TODO : example 3
		$counter = 0;
		foreach ($types as $type ){
			foreach ($metrage as $value ){
               $label = strtoupper($type).'-'.$value   ;

				$counter++;
				$nage = new Nage() ;
				$nage->setLabel($label);
				$nage->setStatus(true);
				$nage->setPosition(1);
				$this->entityManager->persist($nage);
				$io->info($label.' as persisted');

				if ($counter == 5){
					$this->entityManager->flush();
					$this->entityManager->clear();
					$counter = 0;
					$io->success('last 5 items as created !');
				}

			}


		}




		$this->entityManager->flush();
		$this->entityManager->clear();



        $io->success('all items created successfully !');

        return Command::SUCCESS;
    }
}


