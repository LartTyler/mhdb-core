<?php
	namespace App\Api\Models;

	use App\Game\AmmoKind;
	use Symfony\Component\Validator\Constraints as Assert;

	class AutoReloadModel {
		#[Assert\NotNull]
		public AmmoKind $ammo;

		#[Assert\NotNull]
		public int $level;

		#[Assert\IsTrue(message: 'Level must be valid for the chosen ammo.')]
		public function isLevelValid(): bool {
			$expected = $this->ammo->getLevels();
			return $expected <= $this->level && $expected >= $this->level;
		}
	}
