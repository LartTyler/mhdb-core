<?php
	namespace App\Api\Models;

	use App\Entity\Ailment;
	use App\Entity\Location;
	use App\Game\Element;
	use App\Game\MonsterKind;
	use App\Game\Species;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class MonsterModel {
		use PayloadTrait;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public MonsterKind $kind;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Species $species;

		#[Assert\NotBlank(groups: [Intent::CREATE])]
		#[Assert\NotBlank(allowNull: true, groups: [Intent::UPDATE])]
		public ?string $name;

		#[Assert\NotBlank(groups: [Intent::CREATE])]
		#[Assert\NotBlank(allowNull: true, groups: [Intent::UPDATE])]
		public ?string $description;

		/**
		 * @var Ailment[]
		 */
		public array $ailments;

		/**
		 * @var Location[]
		 */
		public array $locations;

		/**
		 * @var Element[]
		 */
		public array $elements;
	}