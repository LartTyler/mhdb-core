<?php
	namespace App\Api\Models;

	use Symfony\Component\Validator\Constraints as Assert;

	class WeaponSharpnessModel {
		#[Assert\NotNull]
		#[Assert\Range(min: 0)]
		public int $red = 0;

		#[Assert\NotNull]
		#[Assert\Range(min: 0)]
		public int $orange = 0;

		#[Assert\NotNull]
		#[Assert\Range(min: 0)]
		public int $yellow = 0;

		#[Assert\NotNull]
		#[Assert\Range(min: 0)]
		public int $green = 0;

		#[Assert\NotNull]
		#[Assert\Range(min: 0)]
		public int $blue = 0;

		#[Assert\NotNull]
		#[Assert\Range(min: 0)]
		public int $white = 0;

		#[Assert\NotNull]
		#[Assert\Range(min: 0)]
		public int $purple = 0;
	}
