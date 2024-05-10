<?php
	namespace App\Entity;

	use App\Game\AmmoKind;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\DBAL\Types\Types;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'weapon_ammo')]
	#[ORM\HasLifecycleCallbacks]
	abstract class Ammo implements EntityInterface {
		use EntityTrait;

		#[ORM\Column(enumType: AmmoKind::class)]
		private AmmoKind $kind;

		/**
		 * @var int[]
		 */
		#[ORM\Column(type: Types::JSON)]
		private array $capacities;

		private int $levels;

		protected function __construct(AmmoKind $kind) {
			$this->kind = $kind;
			$this->levels = $kind->getLevels();
			$this->capacities = array_fill(0, $this->levels, 0);
		}

		public function getKind(): AmmoKind {
			return $this->kind;
		}

		public function getCapacities(): array {
			return $this->capacities;
		}

		public function setCapacities(array $capacities, bool $throwOnError = true): static {
			foreach ($capacities as $index => $capacity)
				$this->setCapacity($index + 1, $capacity, $throwOnError);

			return $this;
		}

		public function setCapacity(int $level, int $value, bool $throwOnError = true): static {
			if ($level < 1 || $level > $this->levels) {
				if (!$throwOnError)
					return $this;

				throw new \UnexpectedValueException(
					sprintf('%s only has %d level%s', static::class, $this->levels, $this->levels !== 1 ? 's' : ''),
				);
			}

			$this->capacities[$level - 1] = $value;
			return $this;
		}

		/**
		 * @internal
		 * @return void
		 */
		#[ORM\PostLoad]
		public function doPostLoad(): void {
			$this->levels = $this->kind->getLevels();
		}
	}
