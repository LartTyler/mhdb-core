<?php
	namespace App\Entity;

	use App\Game\AmmoKind;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity(readOnly: true)]
	#[ORM\Table(name: 'auto_reload')]
	class AutoReload implements EntityInterface {
		use EntityTrait;

		#[ORM\Column(enumType: AmmoKind::class)]
		private AmmoKind $ammo;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $level;

		public function __construct(AmmoKind $ammo, int $level) {
			$this->ammo = $ammo;
			$this->level = $level;
		}

		public function getAmmo(): AmmoKind {
			return $this->ammo;
		}

		public function getLevel(): int {
			return $this->level;
		}
	}
