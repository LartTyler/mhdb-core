<?php
	namespace App\Entity\Weapons;

	use App\Entity\Ammo;
	use App\Entity\AutoReload;
	use App\Entity\RapidFire;
	use App\Entity\Weapon;
	use App\Game\DamageKind;
	use App\Game\Deviation;
	use App\Game\WeaponKind;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class LightBowgun extends Weapon {
		protected WeaponKind $kind = WeaponKind::LightBowgun;

		#[ORM\Column(enumType: Deviation::class)]
		private Deviation $deviation;

		/**
		 * @var Selectable<Ammo>&Collection<Ammo>
		 */
		#[ORM\ManyToMany(targetEntity: Ammo::class)]
		#[ORM\JoinTable(name: 'light_bowgun_ammo')]
		private Collection&Selectable $ammo;

		/**
		 * @var Selectable<AutoReload>&Collection<AutoReload>
		 */
		#[ORM\ManyToMany(targetEntity: AutoReload::class)]
		#[ORM\JoinTable(name: 'light_bowgun_auto_reload')]
		private Collection&Selectable $autoReload;

		/**
		 * @var Selectable<RapidFire>&Collection<RapidFire>
		 */
		#[ORM\ManyToMany(targetEntity: RapidFire::class)]
		#[ORM\JoinTable(name: 'light_bowgun_rapid_fire')]
		private Collection&Selectable $rapidFire;

		public function __construct(string $name, int $rarity, DamageKind $damageKind, Deviation $deviation) {
			parent::__construct($name, $rarity, $damageKind);
			$this->deviation = $deviation;
			$this->ammo = new ArrayCollection();
			$this->autoReload = new ArrayCollection();
			$this->rapidFire = new ArrayCollection();
		}

		public function getDeviation(): Deviation {
			return $this->deviation;
		}

		public function setDeviation(Deviation $deviation): static {
			$this->deviation = $deviation;
			return $this;
		}

		/**
		 * @return Collection<Ammo>&Selectable<Ammo>
		 */
		public function getAmmo(): Selectable&Collection {
			return $this->ammo;
		}

		/**
		 * @return Collection<AutoReload>&Selectable<AutoReload>
		 */
		public function getAutoReload(): Selectable&Collection {
			return $this->autoReload;
		}

		/**
		 * @return Collection<RapidFire>&Selectable<RapidFire>
		 */
		public function getRapidFire(): Selectable&Collection {
			return $this->rapidFire;
		}
	}
