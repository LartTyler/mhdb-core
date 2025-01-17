<?php
	namespace App\Api\Models;

	use App\Entity\Monster;
	use App\Entity\MonsterWeakness;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Serializer\Attribute\DiscriminatorMap;
	use Symfony\Component\Validator\Constraints as Assert;

	#[DiscriminatorMap(
		typeProperty: 'kind',
		mapping: [
			MonsterWeakness::KIND_ELEMENT => MonsterElementWeaknessModel::class,
			MonsterWeakness::KIND_STATUS => MonsterStatusWeaknessModel::class,
		],
	)]
	abstract class MonsterWeaknessModel {
		use PayloadTrait;

		#[Assert\NotNull]
		public string $kind;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Monster $monster;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Range(min: 1)]
		public int $level;

		#[Assert\NotBlank(allowNull: true)]
		public ?string $condition;
	}