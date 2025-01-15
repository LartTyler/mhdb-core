<?php
	namespace App\Api\Models;

	use App\Api\Models\Weapons\BowModel;
	use App\Api\Models\Weapons\ChargeBladeModel;
	use App\Api\Models\Weapons\GunlanceModel;
	use App\Api\Models\Weapons\HeavyBowgunModel;
	use App\Api\Models\Weapons\HuntingHornModel;
	use App\Api\Models\Weapons\LightBowgunModel;
	use App\Api\Models\Weapons\StubWeaponModel;
	use App\Entity\Skill;
	use App\Game\DamageKind;
	use App\Game\Elderseal;
	use App\Game\WeaponKind;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use DaybreakStudios\RestBundle\Payload\PayloadTrait;
	use Symfony\Component\Serializer\Attribute\DiscriminatorMap;
	use Symfony\Component\Validator\Constraints as Assert;

	#[DiscriminatorMap(
		typeProperty: 'kind',
		mapping: [
			WeaponKind::GreatSword->value => StubWeaponModel::class,
			WeaponKind::SwordAndShield->value => StubWeaponModel::class,
			WeaponKind::DualBlades->value => StubWeaponModel::class,
			WeaponKind::LongSword->value => StubWeaponModel::class,
			WeaponKind::Hammer->value => StubWeaponModel::class,
			WeaponKind::HuntingHorn->value => HuntingHornModel::class,
			WeaponKind::Lance->value => StubWeaponModel::class,
			WeaponKind::Gunlance->value => GunlanceModel::class,
			WeaponKind::SwitchAxe->value => StubWeaponModel::class,
			WeaponKind::ChargeBlade->value => ChargeBladeModel::class,
			WeaponKind::InsectGlaive->value => StubWeaponModel::class,
			WeaponKind::Bow->value => BowModel::class,
			WeaponKind::HeavyBowgun->value => HeavyBowgunModel::class,
			WeaponKind::LightBowgun->value => LightBowgunModel::class,
		]
	)]
	class WeaponModel {
		use PayloadTrait;

		#[Assert\NotNull]
		public WeaponKind $kind;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public string $name;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public int $rarity;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public DamageKind $damageKind;

		#[Assert\Valid]
		public DamageValuesModel $damage;

		/**
		 * @var int[]
		 */
		#[Assert\All([
			new Assert\Type('int'),
		])]
		public array $slots;

		/**
		 * @var Skill[]
		 */
		public array $skills;

		/**
		 * @var WeaponSharpnessModel[]
		 */
		#[Assert\Valid]
		public array $sharpness;

		/**
		 * @var WeaponSpecialModel[]
		 */
		#[Assert\Valid]
		public array $specials;

		public int $defenseBonus;
		public ?Elderseal $elderseal;
		public int $affinity;
	}
