<?php
	namespace App\Api\Models;

	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class CharmModel {
		use PayloadTrait;

		#[Assert\NotBlank(groups: [Intent::CREATE])]
		public ?string $name;
	}