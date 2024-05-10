<?php
	namespace App\Entity;

	use App\Game\WeaponSpecialKind;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'weapon_specials')]
	#[ORM\InheritanceType('SINGLE_TABLE')]
	#[ORM\DiscriminatorColumn(name: 'kind', enumType: WeaponSpecialKind::class)]
	#[ORM\DiscriminatorMap([
		WeaponSpecialKind::Element->value => WeaponElement::class,
		WeaponSpecialKind::Status->value => WeaponStatus::class,
	])]
	abstract class WeaponSpecial implements EntityInterface {
		use EntityTrait;

		#[ORM\ManyToOne(targetEntity: Weapon::class, inversedBy: 'specials')]
		#[ORM\JoinColumn(nullable: false)]
		protected Weapon $weapon;

		#[ORM\Embedded]
		protected DamageValues $damage;

		#[ORM\Column]
		protected bool $hidden;

		protected WeaponSpecialKind $kind;

		public function __construct(Weapon $weapon, bool $hidden = false) {
			$this->weapon = $weapon;
			$this->hidden = $hidden;

			$this->damage = new DamageValues();
		}

		public function getKind(): WeaponSpecialKind {
			return $this->kind;
		}

		public function getWeapon(): Weapon {
			return $this->weapon;
		}

		public function getDamage(): DamageValues {
			return $this->damage;
		}

		public function isHidden(): bool {
			return $this->hidden;
		}

		public function setHidden(bool $hidden): static {
			$this->hidden = $hidden;
			return $this;
		}
	}
