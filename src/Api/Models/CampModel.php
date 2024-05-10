<?php
	namespace App\Api\Models;

	use DaybreakStudios\Rest\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class CampModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public string $name;

		#[Assert\NotNull]
		public int $zone;
	}
