<?php
	namespace App\Api\Models;

	use App\Game\DamageKind;
	use App\Game\WeaponKind;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Validator\Constraints as Assert;

	class MotionValueModel {
		use PayloadTrait;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public WeaponKind $weapon;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public ?string $name;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public DamageKind $damage;

		#[Assert\Range(min: 0)]
		public int $stun;

		#[Assert\Range(min: 0)]
		public int $exhaust;

		#[Assert\All([
			new Assert\Type('int'),
			new Assert\Range(min: 1),
		])]
		public array $hits;
	}