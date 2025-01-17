<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\CharmRankModel;
	use App\Api\Transformers\CharmRankTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'charm_ranks')]
	#[AsCrudEntity(
		basePath: '/charms/ranks',
		transformer: CharmRankTransformer::class,
		dtoClass: CharmRankModel::class,
		strict: [
			'charm' => [
				'*',
				'-id',
				'-name',
			],
			'skills' => [
				'skill' => [
					'*',
					'-id',
					'-name',
				],
			],
		],
	)]
	class CharmRank implements EntityInterface {
		use EntityTrait;

		#[ORM\ManyToOne(targetEntity: Charm::class, inversedBy: 'ranks')]
		#[ORM\JoinColumn(onDelete: 'CASCADE')]
		private Charm $charm;

		#[ORM\Column(nullable: true)]
		private ?string $name;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $level;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $rarity;

		/**
		 * @var Selectable<SkillRank>&Collection<SkillRank>
		 */
		#[ORM\ManyToMany(targetEntity: SkillRank::class)]
		#[ORM\JoinTable(name: 'charm_rank_skills')]
		private Collection&Selectable $skills;

		#[ORM\OneToOne(mappedBy: 'charmRank', targetEntity: CharmRankCrafting::class, cascade: ['all'], orphanRemoval: true)]
		private ?CharmRankCrafting $crafting = null;

		public function __construct(Charm $charm, string $name, int $level, int $rarity) {
			$this->charm = $charm;
			$this->name = $name;
			$this->level = $level;
			$this->rarity = $rarity;

			$this->skills = new ArrayCollection();
		}

		public function getCharm(): Charm {
			return $this->charm;
		}

		public function getName(): ?string {
			return $this->name;
		}

		public function setName(?string $name): static {
			$this->name = $name;
			return $this;
		}

		public function getLevel(): int {
			return $this->level;
		}

		public function setLevel(int $level): static {
			$this->level = $level;
			return $this;
		}

		public function getRarity(): int {
			return $this->rarity;
		}

		public function setRarity(int $rarity): static {
			$this->rarity = $rarity;
			return $this;
		}

		public function getSkills(): Selectable&Collection {
			return $this->skills;
		}

		public function getCrafting(): ?CharmRankCrafting {
			return $this->crafting;
		}

		public function setCrafting(?CharmRankCrafting $crafting): static {
			$this->crafting = $crafting;
			return $this;
		}
	}