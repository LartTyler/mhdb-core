<?php
	namespace App\Entity;

	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table('ailment_protections')]
	class AilmentProtection implements EntityInterface {
		use EntityTrait;

		#[ORM\OneToOne(inversedBy: 'protection', targetEntity: Ailment::class, fetch: 'EAGER')]
		#[ORM\JoinColumn(onDelete: 'CASCADE')]
		private Ailment $ailment;

		/**
		 * @var Selectable<Skill>&Collection<Skill>
		 */
		#[ORM\ManyToMany(targetEntity: Skill::class, fetch: 'EAGER')]
		#[ORM\JoinTable(name: 'ailment_protection_skills')]
		private Collection&Selectable $skills;

		/**
		 * @var Selectable<Item>&Collection<Item>
		 */
		#[ORM\ManyToMany(targetEntity: Item::class, fetch: 'EAGER')]
		#[ORM\JoinColumn(name: 'ailment_protection_items')]
		private Collection&Selectable $items;

		public function __construct(Ailment $ailment) {
			$this->ailment = $ailment;

			$this->skills = new ArrayCollection();
			$this->items = new ArrayCollection();
		}

		/**
		 * @return Collection<Skill>&Selectable<Skill>
		 */
		public function getSkills(): Selectable&Collection {
			return $this->skills;
		}

		/**
		 * @return Collection<Item>&Selectable<Item>
		 */
		public function getItems(): Selectable&Collection {
			return $this->items;
		}
	}