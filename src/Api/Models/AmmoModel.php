<?php
	namespace App\Api\Models;

	use App\Game\AmmoKind;
	use Symfony\Component\Validator\Constraints as Assert;

	class AmmoModel {
		#[Assert\NotNull]
		public AmmoKind $kind;

		#[Assert\NotNull]
		public array $capacities;

		#[Assert\IsTrue(message: 'The capacities array has the wrong number of arguments.')]
		public function isCapacitiesValid(): bool {
			return count($this->capacities) === $this->kind->getLevels();
		}
	}
