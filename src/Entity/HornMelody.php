<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\HornMelodyModel;
	use App\Api\Transformers\HornMelodyTransformer;
	use App\Game\Note;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'horn_melodies')]
	#[AsCrudEntity(
		basePath: '/weapons/hunting-horn/melodies',
		transformer: HornMelodyTransformer::class,
		dtoClass: HornMelodyModel::class,
	)]
	class HornMelody implements EntityInterface {
		use EntityTrait;

		/**
		 * @type Note[]
		 * @psalm-var list{Note, Note, Note}
		 */
		#[ORM\Column(enumType: Note::class)]
		private array $notes;

		/**
		 * @var Selectable<HornSong>&Collection<HornSong>
		 */
		#[ORM\OneToMany(mappedBy: 'melody', targetEntity: HornSong::class, cascade: ['all'], orphanRemoval: true)]
		private Collection&Selectable $songs;

		/**
		 * @param Note[] $notes
		 * @psalm-param list{Note, Note, Note} $notes
		 */
		public function __construct(array $notes) {
			$this->notes = $notes;
			$this->songs = new ArrayCollection();
		}

		/**
		 * @return Note[]
		 * @psalm-return list{Note, Note, Note}
		 */
		public function getNotes(): array {
			return $this->notes;
		}

		/**
		 * @param Note[] $notes
		 * @psalm-param list{Note, Note, Note} $notes
		 *
		 * @return $this
		 */
		public function setNotes(array $notes): static {
			$this->notes = $notes;
			return $this;
		}

		/**
		 * @return Collection<HornSong>&Selectable<HornSong>
		 */
		public function getSongs(): Selectable&Collection {
			return $this->songs;
		}
	}
