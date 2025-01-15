<?php
	namespace App\Api\Models\Weapons;

	use App\Api\Models\WeaponModel;
	use App\Game\BowCoating;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class BowModel extends WeaponModel {
		/**
		 * @var BowCoating[]
		 */
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public array $coatings;
	}
