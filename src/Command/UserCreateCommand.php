<?php
	namespace App\Command;

	use App\Entity\User;
	use App\Security\FirewallRole;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\Console\Attribute\AsCommand;
	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;
	use Symfony\Component\Console\Style\SymfonyStyle;
	use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

	#[AsCommand(
		name: 'app:user:create',
		description: 'Create a new user account',
		aliases: ['user:create']
	)]
	class UserCreateCommand extends Command {
		public function __construct(
			protected EntityManagerInterface $entityManager,
			protected UserPasswordHasherInterface $passwordHasher,
		) {
			parent::__construct();
		}

		protected function configure(): void {
			$this
				->addArgument('email-address', InputArgument::REQUIRED)
				->addOption(
					'password',
					'p',
					InputOption::VALUE_NONE,
					'If set, prompt for a password instead of sending an activation email.',
				)
				->addOption(
					'role',
					mode: InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
					description: 'One or more roles to assign to the new user',
					default: [FirewallRole::USER],
				);
		}

		protected function interact(InputInterface $input, OutputInterface $output): void {
			$io = new SymfonyStyle($input, $output);

			if (!$input->getArgument('email-address'))
				$input->setArgument('email-address', $io->ask('Email address'));
		}

		protected function execute(InputInterface $input, OutputInterface $output): int {
			$io = new SymfonyStyle($input, $output);

			$existing = $this->entityManager->getRepository(User::class)
				->findByEmailAddress($email = $input->getArgument('email-address'));

			if ($existing) {
				$io->error('A user with this email address already exists.');
				return static::INVALID;
			}

			$user = new User($email, $input->getOption('role'));
			$this->entityManager->persist($user);

			if ($input->getOption('password')) {
				$password = $io->askHidden('Password');
				$user->setPassword($this->passwordHasher->hashPassword($user, $password));
			} else {
				$io->error('Activation emails have not been implemented yet.');
				return static::FAILURE;
			}

			$this->entityManager->flush();
			$io->success('Created ' . $user);

			return static::SUCCESS;
		}
	}
