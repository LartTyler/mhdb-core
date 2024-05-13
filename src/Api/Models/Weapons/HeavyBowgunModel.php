<?php
	namespace App\Api\Models\Weapons;

	use App\Api\Models\AmmoModel;
	use App\Api\Models\AutoReloadModel;
	use App\Api\Models\WeaponModel;
	use App\Game\Deviation;
	use App\Game\HeavyBowgunSpecialAmmo;
	use DaybreakStudios\Rest\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class HeavyBowgunModel extends WeaponModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Deviation $deviation;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public HeavyBowgunSpecialAmmo $specialAmmo;

		/**
		 * @var AmmoModel[]
		 */
		#[Assert\Valid(traverse: true)]
		public array $ammo;

		/**
		 * @var AutoReloadModel[]
		 */
		#[Assert\Valid(traverse: true)]
		public array $autoReload;
	}
