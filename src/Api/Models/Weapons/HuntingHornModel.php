<?php
	namespace App\Api\Models\Weapons;

	use App\Api\Models\WeaponModel;
	use App\Entity\HornMelody;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class HuntingHornModel extends WeaponModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public HornMelody $melody;
	}
