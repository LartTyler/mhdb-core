<?php
	namespace App\Api\Models\Weapons;

	use App\Api\Models\WeaponModel;
	use App\Game\GunlanceShell;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class GunlanceModel extends WeaponModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public GunlanceShell $shell;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public int $shellLevel;
	}
