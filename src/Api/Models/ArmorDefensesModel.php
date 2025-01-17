<?php
	namespace App\Api\Models;

	use Symfony\Component\Validator\Constraints as Assert;

	class ArmorDefensesModel {
		#[Assert\Range(min: 0)]
		public int $base;

		#[Assert\Range(min: 0)]
		public int $max;

		#[Assert\Range(min: 0)]
		public int $augmented;
	}