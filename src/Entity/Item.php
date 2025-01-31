<?php
	namespace App\Entity;

	use DaybreakStudios\RestBundle\Entity\AsCrudEntity;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\DBAL\Types\Types;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'items')]
	#[AsCrudEntity(
		basePath: '/items',
	)]
	class Item implements EntityInterface {
		use EntityTrait;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $rarity;

		#[Translatable]
		#[ORM\Column(length: 64, unique: true, nullable: true)]
		private ?string $name;

		#[Translatable]
		#[ORM\Column(type: Types::TEXT, nullable: true)]
		private ?string $description = null;

		#[ORM\Column(name: '_value', options: ['unsigned' => true])]
		private int $value = 0;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $carryLimit = 0;

		public function __construct(string $name, int $rarity) {
			$this->name = $name;
			$this->rarity = $rarity;
		}

		public function getRarity(): int {
			return $this->rarity;
		}

		public function setRarity(int $rarity): static {
			$this->rarity = $rarity;
			return $this;
		}

		public function getName(): ?string {
			return $this->name;
		}

		public function setName(?string $name): static {
			$this->name = $name;
			return $this;
		}

		public function getDescription(): ?string {
			return $this->description;
		}

		public function setDescription(?string $description): static {
			$this->description = $description;
			return $this;
		}

		public function getValue(): int {
			return $this->value;
		}

		public function setValue(int $value): static {
			$this->value = $value;
			return $this;
		}

		public function getCarryLimit(): int {
			return $this->carryLimit;
		}

		public function setCarryLimit(int $carryLimit): static {
			$this->carryLimit = $carryLimit;
			return $this;
		}
	}