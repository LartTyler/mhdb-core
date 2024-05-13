<?php
	namespace App\Api\Models;

	use DaybreakStudios\Rest\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class SkillModel {
		#[Assert\NotBlank(groups: [Intent::CREATE])]
		public string $name;

		#[Assert\NotBlank(allowNull: true)]
		public string $description;
	}
