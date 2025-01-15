<?php
	namespace App\Api\Models\Weapons;

	use App\Api\Models\WeaponModel;
	use App\Game\ChargeBladePhial;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class ChargeBladeModel extends WeaponModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public ChargeBladePhial $phial;
	}
