<?php
	namespace App\Entity;

	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity(readOnly: true)]
	#[ORM\Table(name: 'horn_songs')]
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
	}
