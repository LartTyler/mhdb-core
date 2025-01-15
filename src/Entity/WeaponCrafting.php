<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\WeaponCraftingModel;
	use App\Api\Transformers\WeaponCraftingTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'weapon_crafting')]
	#[AsCrudEntity(
		basePath: '/weapons/crafting',
		transformer: WeaponCraftingTransformer::class,
		dtoClass: WeaponCraftingModel::class,
		strict: [
			'previous' => [
				'*',
				'-id',
				'-name',
			],
			'branches' => [
				'*',
				'-id',
				'-name',
			],
		],
	)]
	class WeaponCrafting implements EntityInterface {
		use EntityTrait;

		#[ORM\Column]
		private bool $craftable;

		#[ORM\ManyToOne]
		private ?Weapon $previous;

		/**
		 * @var Collection<Weapon>&Selectable<Weapon>
		 */
		#[ORM\ManyToMany(targetEntity: Weapon::class, orphanRemoval: true)]
		#[ORM\JoinTable(name: 'weapon_crafting_branches')]
		private Collection&Selectable $branches;

		/**
		 * @var Collection<MaterialCost>&Selectable<MaterialCost>
		 */
		#[ORM\ManyToMany(targetEntity: MaterialCost::class, cascade: ['all'], orphanRemoval: true)]
		#[ORM\JoinTable(name: 'weapon_crafting_costs')]
		private Collection&Selectable $craftingMaterials;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $craftingZennyCost = 0;

		#[ORM\ManyToMany(targetEntity: MaterialCost::class, cascade: ['all'], orphanRemoval: true)]
		#[ORM\JoinTable(name: 'weapon_crafting_upgrade_costs')]
		private Collection&Selectable $upgradeMaterials;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $upgradeZennyCost = 0;

		public function __construct(bool $craftable, ?Weapon $previous) {
			$this->craftable = $craftable;
			$this->previous = $previous;

			$this->branches = new ArrayCollection();
			$this->craftingMaterials = new ArrayCollection();
			$this->upgradeMaterials = new ArrayCollection();
		}

		public function isCraftable(): bool {
			return $this->craftable;
		}

		public function setCraftable(bool $craftable): static {
			$this->craftable = $craftable;
			return $this;
		}

		public function getPrevious(): ?Weapon {
			return $this->previous;
		}

		public function setPrevious(?Weapon $previous): static {
			$this->previous = $previous;
			return $this;
		}

		public function getBranches(): Selectable&Collection {
			return $this->branches;
		}

		public function getCraftingMaterials(): Selectable&Collection {
			return $this->craftingMaterials;
		}

		public function getCraftingZennyCost(): int {
			return $this->craftingZennyCost;
		}

		public function setCraftingZennyCost(int $craftingZennyCost): static {
			$this->craftingZennyCost = $craftingZennyCost;
			return $this;
		}

		public function getUpgradeMaterials(): Selectable&Collection {
			return $this->upgradeMaterials;
		}

		public function getUpgradeZennyCost(): int {
			return $this->upgradeZennyCost;
		}

		public function setUpgradeZennyCost(int $upgradeZennyCost): static {
			$this->upgradeZennyCost = $upgradeZennyCost;
			return $this;
		}
	}