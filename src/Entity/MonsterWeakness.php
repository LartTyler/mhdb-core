<?php
	namespace App\Entity;

	use DaybreakStudios\RestBundle\Entity\AsCrudEntity;
	use App\Api\Models\MonsterWeaknessModel;
	use App\Api\Transformers\MonsterWeaknessTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\DBAL\Types\Types;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'monster_weaknesses')]
	#[ORM\InheritanceType('SINGLE_TABLE')]
	#[ORM\DiscriminatorColumn(name: 'kind')]
	#[ORM\DiscriminatorMap([
		self::KIND_ELEMENT => MonsterElementWeakness::class,
		self::KIND_STATUS => MonsterStatusWeakness::class,
	])]
	#[AsCrudEntity(
		basePath: '/monsters/weaknesses',
		transformer: MonsterWeaknessTransformer::class,
		dtoClass: MonsterWeaknessModel::class,
		strict: [
			'monster' => [
				'*',
				'-id',
				'-name',
			],
		],
	)]
	abstract class MonsterWeakness implements EntityInterface {
		public const KIND_ELEMENT = 'element';
		public const KIND_STATUS = 'status';

		use EntityTrait;

		/**
		 * @var static::KIND_*
		 */
		protected string $kind;

		#[ORM\ManyToOne(targetEntity: Monster::class, fetch: 'EAGER', inversedBy: 'weaknesses')]
		#[ORM\JoinColumn(onDelete: 'CASCADE')]
		private Monster $monster;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $level;

		#[Translatable]
		#[ORM\Column(type: Types::TEXT, nullable: true)]
		private ?string $condition = null;

		public function __construct(Monster $monster, int $level) {
			$this->monster = $monster;
			$this->level = $level;
		}

		/**
		 * @return static::KIND_*
		 */
		public function getKind(): string {
			return $this->kind;
		}

		public function getLevel(): int {
			return $this->level;
		}

		public function setLevel(int $level): static {
			$this->level = $level;
			return $this;
		}

		public function getCondition(): ?string {
			return $this->condition;
		}

		public function setCondition(?string $condition): static {
			$this->condition = $condition;
			return $this;
		}
	}