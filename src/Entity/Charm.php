<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\CharmModel;
	use App\Api\Transformers\CharmTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'charms')]
	#[AsCrudEntity(
		basePath: '/charms',
		transformer: CharmTransformer::class,
		dtoClass: CharmModel::class,
		strict: [
			'ranks' => [
				'skills' => [
					'skill' => [
						'*',
						'-id',
						'-name',
					],
				],
			],
		],
	)]
	class Charm implements EntityInterface {
		use EntityTrait;

		#[ORM\Column(nullable: true)]
		private ?string $name;

		/**
		 * @var Selectable<CharmRank>&Collection<CharmRank>
		 */
		#[ORM\OneToMany(mappedBy: 'charm', targetEntity: CharmRank::class, cascade: ['all'], orphanRemoval: true)]
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
		 * @return Collection<CharmRank>&Selectable<CharmRank>
		 */
		public function getRanks(): Selectable&Collection {
			return $this->ranks;
		}
	}