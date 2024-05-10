<?php
	namespace App\Entity;

	use App\Repository\UserRepository;
	use App\Security\FirewallRole;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\DBAL\Types\Types;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
	use Symfony\Component\Security\Core\User\UserInterface;

	#[ORM\Entity(repositoryClass: UserRepository::class)]
	#[ORM\Table(name: 'users')]
	class User implements EntityInterface, UserInterface, PasswordAuthenticatedUserInterface {
		use EntityTrait;

		#[ORM\Column(length: 254, unique: true)]
		private string $emailAddress;

		#[ORM\Column(type: Types::TEXT, nullable: true)]
		private ?string $password = null;

		#[ORM\Column]
		private array $roles;

		public function __construct(string $emailAddress, array $roles = [FirewallRole::USER]) {
			$this->emailAddress = $emailAddress;
			$this->roles = $roles;
		}

		public function getEmailAddress(): string {
			return $this->emailAddress;
		}

		public function setEmailAddress(string $emailAddress): static {
			$this->emailAddress = $emailAddress;
			return $this;
		}

		public function getPassword(): ?string {
			return $this->password;
		}

		public function setPassword(?string $password): static {
			$this->password = $password;
			return $this;
		}

		public function getRoles(): array {
			return $this->roles;
		}

		public function setRoles(array $roles): static {
			$this->roles = $roles;
			return $this;
		}

		public function eraseCredentials(): void {
			// noop
		}

		public function getUserIdentifier(): string {
			return $this->getEmailAddress();
		}
	}
