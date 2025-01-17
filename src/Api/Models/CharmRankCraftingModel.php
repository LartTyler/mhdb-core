<?php
	namespace App\Api\Models;

	use App\Entity\CharmRank;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class CharmRankCraftingModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public CharmRank $charmRank;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public bool $craftable;

		/**
		 * @var MaterialCostModel[]
		 */
		#[Assert\Valid]
		public array $materials;

		#[Assert\Range(min: 0)]
		public int $zennyCost;
	}