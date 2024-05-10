<?php
	namespace App\Entity\Weapons;

	use App\Entity\Weapon;
	use App\Game\ChargeBladePhial;
	use App\Game\DamageKind;
	use App\Game\WeaponKind;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class ChargeBlade extends Weapon {
		protected WeaponKind $kind = WeaponKind::ChargeBlade;

		private ChargeBladePhial $phial;

		public function __construct(string $name, int $rarity, DamageKind $damageKind, ChargeBladePhial $phial) {
			parent::__construct($name, $rarity, $damageKind);
			$this->phial = $phial;
		}

		public function getPhial(): ChargeBladePhial {
			return $this->phial;
		}

		public function setPhial(ChargeBladePhial $phial): static {
			$this->phial = $phial;
			return $this;
		}
	}
