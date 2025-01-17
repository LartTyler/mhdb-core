<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\MonsterResistanceModel;
	use App\Api\Transformers\MonsterResistanceTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\DBAL\Types\Types;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'monster_resistances')]
	#[ORM\InheritanceType('SINGLE_TABLE')]
	#[ORM\DiscriminatorColumn(name: 'kind')]
	#[ORM\DiscriminatorMap([
		static::KIND_ELEMENT => MonsterElementResistance::class,
		static::KIND_STATUS => MonsterStatusResistance::class,
	])]
	#[AsCrudEntity(
		basePath: '/monsters/resistances',
		transformer: MonsterResistanceTransformer::class,
		dtoClass: MonsterResistanceModel::class,
		strict: [
			'monster' => [
				'*',
				'-id',
				'-name',
			],
		],
	)]
	class MonsterResistance implements EntityInterface {
		public const KIND_ELEMENT = 'element';
		public const KIND_STATUS = 'status';

		use EntityTrait;

		/**
		 * @var static::KIND_*
		 */
		protected string $kind;

		#[ORM\ManyToOne(targetEntity: Monster::class, inversedBy: 'resistances')]
		#[ORM\JoinColumn(onDelete: 'CASCADE')]
		private Monster $monster;

		#[Translatable]
		#[ORM\Column(name: '_condition', type: Types::TEXT, nullable: true)]
		private ?string $condition = null;

		public function __construct(Monster $monster) {
			$this->monster = $monster;
		}

		/**
		 * @return static::KIND_*
		 */
		public function getKind(): string {
			return $this->kind;
		}

		public function getCondition(): ?string {
			return $this->condition;
		}

		public function setCondition(?string $condition): static {
			$this->condition = $condition;
			return $this;
		}
	}