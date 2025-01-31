<?php
	namespace App\Entity;

	use DaybreakStudios\RestBundle\Entity\AsCrudEntity;
	use App\Api\Models\DecorationModel;
	use App\Api\Transformers\DecorationTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'decorations')]
	#[AsCrudEntity(
		basePath: '/decorations',
		transformer: DecorationTransformer::class,
		dtoClass: DecorationModel::class,
		strict: [
			'skills' => [
				'skill' => [
					'*',
					'-id',
					'-name',
				],
			],
		],
	)]
	class Decoration implements EntityInterface {
		use EntityTrait;

		#[Translatable]
		#[ORM\Column(nullable: true)]
		private ?string $name;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $slot;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $rarity;

		/**
		 * @var Selectable<SkillRank>&Collection<SkillRank>
		 */
		#[ORM\ManyToMany(targetEntity: SkillRank::class)]
		#[ORM\JoinTable(name: 'decoration_skills')]
		private Collection&Selectable $skills;

		public function __construct(string $name, int $slot, int $rarity) {
			$this->name = $name;
			$this->slot = $slot;
			$this->rarity = $rarity;

			$this->skills = new ArrayCollection();
		}

		public function getName(): ?string {
			return $this->name;
		}

		public function setName(?string $name): static {
			$this->name = $name;
			return $this;
		}

		public function getSlot(): int {
			return $this->slot;
		}

		public function setSlot(int $slot): static {
			$this->slot = $slot;
			return $this;
		}

		public function getRarity(): int {
			return $this->rarity;
		}

		public function setRarity(int $rarity): static {
			$this->rarity = $rarity;
			return $this;
		}

		/**
		 * @return Collection<SkillRank>&Selectable<SkillRank>
		 */
		public function getSkills(): Selectable&Collection {
			return $this->skills;
		}
	}