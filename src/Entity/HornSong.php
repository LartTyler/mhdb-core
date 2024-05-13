<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\HornSongModel;
	use App\Api\Transformers\HornSongTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity(readOnly: true)]
	#[ORM\Table(name: 'horn_songs')]
	#[AsCrudEntity(
		basePath: '/weapons/hunting-horn/melodies/songs',
		transformer: HornSongTransformer::class,
		dtoClass: HornSongModel::class,
		strict: [
			'melody' => [
				'songs',
			],
		]
	)]
	class HornSong implements EntityInterface {
		use EntityTrait;

		#[ORM\ManyToOne(targetEntity: HornMelody::class, inversedBy: 'songs')]
		#[ORM\JoinColumn(nullable: false)]
		private HornMelody $melody;

		/**
		 * @var int[]
		 */
		#[ORM\Column]
		private array $sequence;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $duration;

		#[Translatable]
		#[ORM\Column(nullable: true)]
		private ?string $effects;

		#[ORM\Column]
		private bool $personal = false;

		/**
		 * @param HornMelody $melody
		 * @param int[]      $sequence
		 * @param int        $duration
		 * @param string     $effects
		 */
		public function __construct(HornMelody $melody, array $sequence, int $duration, string $effects) {
			$this->melody = $melody;
			$this->sequence = $sequence;
			$this->duration = $duration;
			$this->effects = $effects;
		}

		// Where'd you get that melody?
		// I don't know, it came to me. As if I'd known it all along.
		public function getMelody(): HornMelody {
			return $this->melody;
		}

		/**
		 * @return int[]
		 */
		public function getSequence(): array {
			return $this->sequence;
		}

		public function setSequence(array $sequence): static {
			$this->sequence = $sequence;
			return $this;
		}

		public function getDuration(): int {
			return $this->duration;
		}

		public function setDuration(int $duration): static {
			$this->duration = $duration;
			return $this;
		}

		public function getEffects(): ?string {
			return $this->effects;
		}

		public function setEffects(?string $effects): static {
			$this->effects = $effects;
			return $this;
		}

		public function isPersonal(): bool {
			return $this->personal;
		}

		public function setPersonal(bool $personal): static {
			$this->personal = $personal;
			return $this;
		}
	}
