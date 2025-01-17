<?php
	namespace App\Api\Models;

	use Symfony\Component\Validator\Constraints as Assert;

	class ArmorElementResistancesModel {
		#[Assert\Range(min: 0)]
		public int $fire;

		#[Assert\Range(min: 0)]
		public int $water;

		#[Assert\Range(min: 0)]
		public int $ice;

		#[Assert\Range(min: 0)]
		public int $thunder;

		#[Assert\Range(min: 0)]
		public int $dragon;
	}