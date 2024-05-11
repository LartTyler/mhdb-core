<?php
	namespace App\Api\Models;

	use App\Entity\Location;
	use DaybreakStudios\Rest\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class CampModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\IsNull(groups: [Intent::UPDATE])]
		public Location $location;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public string $name;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public int $zone;
	}
