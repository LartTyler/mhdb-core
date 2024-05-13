<?php
	namespace App\Api\Models;

	use Symfony\Component\Validator\Constraints as Assert;

	class DamageValuesModel {
		#[Assert\Range(min: 0)]
		public int $raw;

		#[Assert\Range(min: 0)]
		public int $display;
	}
