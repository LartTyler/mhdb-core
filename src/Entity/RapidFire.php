<?php
	namespace App\Entity;

	use App\Game\AmmoKind;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity(readOnly: true)]
	#[ORM\Table(name: 'rapid_fire')]
	class RapidFire implements EntityInterface {
		use EntityTrait;

		#[ORM\Column(enumType: AmmoKind::class)]
		private AmmoKind $kind;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $level;

		public function __construct(AmmoKind $kind, int $level) {
			$this->kind = $kind;
			$this->level = $level;
		}

		public function getKind(): AmmoKind {
			return $this->kind;
		}

		public function getLevel(): int {
			return $this->level;
		}
	}
