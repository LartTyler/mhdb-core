<?php
	namespace App\Api\Models;

	use App\Entity\ArmorSet;
	use App\Entity\SkillRank;
	use App\Game\ArmorKind;
	use App\Game\Rank;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class ArmorModel {
		use PayloadTrait;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public ArmorKind $kind;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Rank $rank;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public int $rarity;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public ?string $name;

		/**
		 * @var SkillRank[]
		 */
		public array $skills;

		/**
		 * @var int[]
		 */
		#[Assert\All([
			new Assert\Type('int'),
			new Assert\Range(min: 1),
		])]
		public array $slots;

		public ?ArmorSet $armorSet;

		#[Assert\Valid]
		public ArmorElementResistancesModel $resistances;

		#[Assert\Valid]
		public ArmorDefensesModel $defense;
	}