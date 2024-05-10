<?php
	namespace App\Entity\Weapons;

	use App\Entity\Weapon;
	use App\Game\WeaponKind;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class SwordShield extends Weapon {
		protected WeaponKind $kind = WeaponKind::SwordAndShield;
	}
