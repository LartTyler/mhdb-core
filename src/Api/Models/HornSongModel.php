<?php
	namespace App\Api\Models;

	use App\Entity\HornMelody;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class HornSongModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\IsNull(groups: [Intent::UPDATE])]
		public HornMelody $melody;

		/**
		 * @var int[]
		 */
		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Count(min: 2)]
		#[Assert\All([
			new Assert\Type('int'),
		])]
		public array $sequence;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public int $duration;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\NotBlank(allowNull: true)]
		public string $effects;

		public bool $personal;
	}
