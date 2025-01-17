<?php
	namespace App\Api\Models;

	use App\Entity\Charm;
	use App\Entity\SkillRank;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class CharmRankModel {
		use PayloadTrait;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Charm $charm;

		#[Assert\NotBlank(groups: [Intent::CREATE])]
		public ?string $name;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Range(min: 1)]
		public int $level;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Range(min: 1)]
		public int $rarity;

		/**
		 * @var SkillRank[]
		 */
		public array $skills;
	}