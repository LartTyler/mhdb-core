<?php
	namespace App\Api\Models;

	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class LocationModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public string $name;

		#[Assert\Range(min: 1)]
		public int $zoneCount;
	}
