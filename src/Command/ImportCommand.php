<?php
	namespace App\Command;

	use App\Import\AsImporter;
	use App\Import\BatchManager;
	use App\Import\ImportContext;
	use App\Import\ImporterInterface;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\Console\Attribute\AsCommand;
	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

	#[AsCommand(
		name: 'app:import',
		description: 'Imports game data by sequentially invoking all services tagged with `' . AsImporter::TAG . '`',
	)]
	class ImportCommand extends Command {
		public function __construct(
			protected EntityManagerInterface $entityManager,
			#[AutowireIterator(AsImporter::TAG)]
			protected iterable $importers,
		) {
			parent::__construct();
		}

		protected function configure(): void {
			$this
				->addArgument(
					'data-root',
					InputArgument::REQUIRED,
					'Path to the directory containing all the CSVs to import',
				)
				->addOption(
					'batch-size',
					'b',
					InputOption::VALUE_REQUIRED,
					'The number of objects to process before flushing changes to the database; set to zero to disable batching',
					100,
				);
		}

		protected function execute(InputInterface $input, OutputInterface $output): int {
			$batch = new BatchManager($this->entityManager, (int)$input->getOption('batch-size'));
			$context = new ImportContext($batch, $input->getArgument('data-root'));

			foreach ($this->importers as $importer) {
				if ($importer instanceof ImporterInterface)
					$importer->import($context);
				else
					$importer($context);
			}

			return static::SUCCESS;
		}
	}