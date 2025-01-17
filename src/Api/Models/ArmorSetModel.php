<?php
	namespace App\Api\Models;

	use App\Entity\Armor;
	use App\Entity\ArmorSetBonus;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class ArmorSetModel {
		use PayloadTrait;

		#[Assert\NotBlank(groups: [Intent::CREATE])]
		public ?string $name;

		/**
		 * @var Armor[]
		 */
		public array $pieces;

		public ?ArmorSetBonus $bonus;
	}