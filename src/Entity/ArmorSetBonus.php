<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\ArmorSetBonusModel;
	use App\Api\Transformers\ArmorSetBonusTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'armor_set_bonuses')]
	#[AsCrudEntity(
		basePath: '/armor/sets/bonuses',
		transformer: ArmorSetBonusTransformer::class,
		dtoClass: ArmorSetBonusModel::class,
		strict: [
			'ranks' => [
				'skill' => [
					'skill' => [
						'*',
						'-id',
						'-name',
					],
				],
			],
		],
	)]
	class ArmorSetBonus implements EntityInterface {
		use EntityTrait;

		#[Translatable]
		#[ORM\Column(nullable: true)]
		private ?string $name;

		/**
		 * @var Selectable<ArmorSetBonusRank>&Collection<ArmorSetBonusRank>
		 */
		#[ORM\OneToMany(mappedBy: 'bonus', targetEntity: ArmorSetBonusRank::class, cascade: ['all'], orphanRemoval: true)]
		private Collection&Selectable $ranks;

		public function __construct(string $name) {
			$this->name = $name;
			$this->ranks = new ArrayCollection();
		}

		public function getName(): ?string {
			return $this->name;
		}

		public function setName(?string $name): static {
			$this->name = $name;
			return $this;
		}

		/**
		 * @return Collection<ArmorSetBonusRank>&Selectable<ArmorSetBonusRank>
		 */
		public function getRanks(): Selectable&Collection {
			return $this->ranks;
		}
	}