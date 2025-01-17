<?php
	namespace App\Api\Models;

	use App\Entity\Armor;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class ArmorCraftingModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Armor $armor;

		/**
		 * @var MaterialCostModel[]
		 */
		#[Assert\Valid]
		public array $materials;

		#[Assert\Range(min: 0)]
		public int $zennyCost;
	}