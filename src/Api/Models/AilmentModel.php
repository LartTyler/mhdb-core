<?php
	namespace App\Api\Models;

	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class AilmentModel {
		use PayloadTrait;

		#[Assert\NotBlank(groups: [Intent::CREATE])]
		public ?string $name;

		public ?string $description;

		#[Assert\Valid]
		public AilmentRecoveryModel $recovery;

		#[Assert\Valid]
		public AilmentProtectionModel $protection;
	}