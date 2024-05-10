<?php
	namespace App\Entity\Weapons;

	use App\Entity\HornMelody;
	use App\Entity\Weapon;
	use App\Game\DamageKind;
	use App\Game\WeaponKind;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class HuntingHorn extends Weapon {
		protected WeaponKind $kind = WeaponKind::HuntingHorn;

		#[ORM\ManyToOne(targetEntity: HornMelody::class)]
		private HornMelody $melody;

		public function __construct(string $name, int $rarity, DamageKind $damageKind, HornMelody $melody) {
			parent::__construct($name, $rarity, $damageKind);
			$this->melody = $melody;
		}

		public function getMelody(): HornMelody {
			return $this->melody;
		}

		public function setMelody(HornMelody $melody): static {
			$this->melody = $melody;
			return $this;
		}
	}
