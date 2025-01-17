<?php
	namespace App\Api\Models;

	use App\Entity\MonsterReward;
	use App\Game\MonsterRewardConditionKind;
	use App\Game\Rank;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class MonsterRewardConditionModel {
		use PayloadTrait;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public MonsterReward $reward;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public MonsterRewardConditionKind $kind;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Rank $rank;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Range(min: 1)]
		public int $quantity;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Range(min: 1)]
		public int $chance;

		public ?string $subtype;
	}