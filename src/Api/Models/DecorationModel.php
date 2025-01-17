<?php
	namespace App\Api\Models;

	use App\Entity\SkillRank;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class DecorationModel {
		use PayloadTrait;

		#[Assert\NotBlank(groups: [Intent::CREATE])]
		public ?string $name;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Range(min: 1)]
		public int $slot;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Range(min: 1)]
		public int $rarity;

		/**
		 * @var SkillRank[]
		 */
		public array $skills;
	}