<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\SkillRankModel;
	use App\Api\Transformers\SkillRankTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\DBAL\Types\Types;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'skill_ranks')]
	#[AsCrudEntity(
		basePath: '/skills/ranks',
		transformer: SkillRankTransformer::class,
		dtoClass: SkillRankModel::class,
		strict: [
			'skill' => [
				'ranks',
			],
		]
	)]
	class SkillRank implements EntityInterface {
		use EntityTrait;

		#[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'ranks')]
		#[ORM\JoinColumn(nullable: false)]
		private Skill $skill;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $level;

		#[Translatable]
		#[ORM\Column(type: Types::TEXT, nullable: true)]
		private ?string $description = null;

		public function __construct(Skill $skill, int $level) {
			$this->skill = $skill;
			$this->level = $level;
		}

		public function getSkill(): Skill {
			return $this->skill;
		}

		public function getLevel(): int {
			return $this->level;
		}

		public function setLevel(int $level): static {
			$this->level = $level;
			return $this;
		}

		public function getDescription(): ?string {
			return $this->description;
		}

		public function setDescription(?string $description): static {
			$this->description = $description;
			return $this;
		}
	}
