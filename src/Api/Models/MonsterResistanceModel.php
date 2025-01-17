<?php
	namespace App\Api\Models;

	use App\Entity\Monster;
	use App\Entity\MonsterResistance;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Serializer\Attribute\DiscriminatorMap;
	use Symfony\Component\Validator\Constraints as Assert;

	#[DiscriminatorMap(
		typeProperty: 'kind',
		mapping: [
			MonsterResistance::KIND_ELEMENT => MonsterElementResistanceModel::class,
			MonsterResistance::KIND_STATUS => MonsterStatusResistanceModel::class,
		],
	)]
	abstract class MonsterResistanceModel {
		use PayloadTrait;

		#[Assert\NotNull]
		public string $kind;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Monster $monster;

		public ?string $condition;
	}