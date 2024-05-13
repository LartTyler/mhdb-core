<?php
	namespace App\Api\Models;

	use App\Game\WeaponSpecialKind;
	use Symfony\Component\Serializer\Attribute\DiscriminatorMap;
	use Symfony\Component\Validator\Constraints as Assert;

	#[DiscriminatorMap(
		typeProperty: 'kind',
		mapping: [
			WeaponSpecialKind::Element->value => WeaponElementModel::class,
			WeaponSpecialKind::Status->value => WeaponSpecialModel::class,
		]
	)]
	abstract class WeaponSpecialModel {
		#[Assert\NotNull]
		public WeaponSpecialKind $kind;

		#[Assert\NotNull]
		public bool $hidden;

		#[Assert\Valid]
		public DamageValuesModel $damage;
	}
