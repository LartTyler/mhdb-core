<?php
	namespace App\Api\Models;

	use App\Entity\Weapon;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class WeaponCraftingModel {
		use PayloadTrait;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Weapon $weapon;

		public ?Weapon $previous;

		public bool $craftable;

		/**
		 * @var Weapon[]
		 */
		public array $branches;

		/**
		 * @var MaterialCostModel[]
		 */
		#[Assert\Valid]
		public array $craftingMaterials;

		public int $craftingZennyCost;

		/**
		 * @var MaterialCostModel[]
		 */
		#[Assert\Valid]
		public array $upgradeMaterials;

		public int $upgradeZennyCost;
	}