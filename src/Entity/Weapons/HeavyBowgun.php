<?php
	namespace App\Entity\Weapons;

	use App\Entity\Ammo;
	use App\Entity\AutoReload;
	use App\Entity\Weapon;
	use App\Game\DamageKind;
	use App\Game\Deviation;
	use App\Game\HeavyBowgunSpecialAmmo;
	use App\Game\WeaponKind;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class HeavyBowgun extends Weapon {
		protected WeaponKind $kind = WeaponKind::HeavyBowgun;

		#[ORM\Column(enumType: Deviation::class)]
		private Deviation $deviation;

		#[ORM\Column(enumType: HeavyBowgunSpecialAmmo::class)]
		private HeavyBowgunSpecialAmmo $specialAmmo;

		/**
		 * @var Selectable<Ammo>&Collection<Ammo>
		 */
		#[ORM\ManyToMany(targetEntity: Ammo::class)]
		#[ORM\JoinTable(name: 'heavy_bowgun_ammo')]
		private Collection&Selectable $ammo;

		/**
		 * @var Selectable<AutoReload>&Collection<AutoReload>
		 */
		#[ORM\ManyToMany(targetEntity: AutoReload::class)]
		#[ORM\JoinTable(name: 'heavy_bowgun_auto_reload')]
		private Collection&Selectable $autoReload;

		public function __construct(
			string $name,
			int $rarity,
			DamageKind $damageKind,
			Deviation $deviation,
			HeavyBowgunSpecialAmmo $specialAmmo,
		) {
			parent::__construct($name, $rarity, $damageKind);
			$this->deviation = $deviation;
			$this->specialAmmo = $specialAmmo;
			$this->ammo = new ArrayCollection();
			$this->autoReload = new ArrayCollection();
		}

		public function getDeviation(): Deviation {
			return $this->deviation;
		}

		public function setDeviation(Deviation $deviation): static {
			$this->deviation = $deviation;
			return $this;
		}

		public function getSpecialAmmo(): HeavyBowgunSpecialAmmo {
			return $this->specialAmmo;
		}

		public function setSpecialAmmo(HeavyBowgunSpecialAmmo $specialAmmo): static {
			$this->specialAmmo = $specialAmmo;
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
	}
