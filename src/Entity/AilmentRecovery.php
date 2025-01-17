<?php
	namespace App\Entity;

	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'ailment_recoveries')]
	class AilmentRecovery implements EntityInterface {
		use EntityTrait;

		#[ORM\OneToOne(inversedBy: 'recovery', targetEntity: Ailment::class, fetch: 'EAGER')]
		#[ORM\JoinColumn(onDelete: 'CASCADE')]
		private Ailment $ailment;

		/**
		 * @var Selectable<Item>&Collection<Item>
		 */
		#[ORM\ManyToMany(targetEntity: Item::class, fetch: 'EAGER')]
		#[ORM\JoinTable(name: 'ailment_recovery_items')]
		private Collection&Selectable $items;

		/**
		 * @var string[]
		 */
		#[ORM\Column]
		private array $actions = [];

		public function __construct(Ailment $ailment) {
			$this->ailment = $ailment;
			$this->items = new ArrayCollection();
		}

		/**
		 * @return Collection<Item>&Selectable<Item>
		 */
		public function getItems(): Selectable&Collection {
			return $this->items;
		}

		/**
		 * @return string[]
		 */
		public function getActions(): array {
			return $this->actions;
		}

		/**
		 * @param string[] $actions
		 *
		 * @return $this
		 */
		public function setActions(array $actions): static {
			$this->actions = $actions;
			return $this;
		}
	}