<?php
	namespace App\Entity;

	use App\Game\Note;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\Common\Collections\Selectable;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'horn_melodies')]
	class HornMelody implements EntityInterface {
		use EntityTrait;

		#[ORM\Column(enumType: Note::class)]
		private array $notes;

		/**
		 * @var Selectable<HornSong>&Collection<HornSong>
		 */
		#[ORM\OneToMany(targetEntity: HornSong::class, mappedBy: 'melody', cascade: ['all'], orphanRemoval: true)]
		private Collection&Selectable $songs;

		public function __construct() {
			$this->songs = new ArrayCollection();
		}

		public function getNotes(): array {
			return $this->notes;
		}

		public function setNotes(Note $a, Note $b, Note $c): static {
			$this->notes = [$a, $b, $c];
			return $this;
		}

		/**
		 * @return Collection<HornSong>&Selectable<HornSong>
		 */
		public function getSongs(): Selectable&Collection {
			return $this->songs;
		}
	}
