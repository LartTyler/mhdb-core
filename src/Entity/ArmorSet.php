<?php
	namespace App\Entity;

	use DaybreakStudios\RestBundle\Entity\AsCrudEntity;
	use App\Api\Models\ArmorSetModel;
	use App\Api\Transformers\ArmorSetTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'armor_sets')]
	#[AsCrudEntity(
		basePath: '/armor/sets',
		transformer: ArmorSetTransformer::class,
		dtoClass: ArmorSetModel::class,
		strict: [
			'pieces' => [
				'*',
				'-id',
				'-name',
			],
		],
	)]
	class ArmorSet implements EntityInterface {
		use EntityTrait;

		#[Translatable]
		#[ORM\Column(nullable: true)]
		private ?string $name;

		/**
		 * @var Selectable<Armor>&Collection<Armor>
		 */
		#[ORM\OneToMany(mappedBy: 'armorSet', targetEntity: Armor::class)]
		private Collection&Selectable $pieces;

		#[ORM\ManyToOne]
		#[ORM\JoinColumn(onDelete: 'SET NULL')]
		private ?ArmorSetBonus $bonus = null;

		public function __construct(string $name) {
			$this->name = $name;
			$this->pieces = new ArrayCollection();
		}

		public function getName(): ?string {
			return $this->name;
		}

		public function setName(?string $name): static {
			$this->name = $name;
			return $this;
		}

		/**
		 * @return Collection<Armor>&Selectable<Armor>
		 */
		public function getPieces(): Selectable&Collection {
			return $this->pieces;
		}

		public function getBonus(): ?ArmorSetBonus {
			return $this->bonus;
		}

		public function setBonus(?ArmorSetBonus $bonus): static {
			$this->bonus = $bonus;
			return $this;
		}
	}