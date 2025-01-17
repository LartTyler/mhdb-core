<?php
	namespace App\Entity;

	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	#[ORM\Table(name: 'armor_set_bonus_ranks')]
	class ArmorSetBonusRank implements EntityInterface {
		use EntityTrait;

		#[ORM\ManyToOne(targetEntity: ArmorSetBonus::class, inversedBy: 'ranks')]
		#[ORM\JoinColumn(onDelete: 'CASCADE')]
		private ArmorSetBonus $bonus;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $pieces;

		#[ORM\ManyToOne]
		private SkillRank $skill;

		public function __construct(ArmorSetBonus $bonus, int $pieces, SkillRank $skill) {
			$this->bonus = $bonus;
			$this->pieces = $pieces;
			$this->skill = $skill;
		}

		public function getBonus(): ArmorSetBonus {
			return $this->bonus;
		}

		public function getPieces(): int {
			return $this->pieces;
		}

		public function setPieces(int $pieces): static {
			$this->pieces = $pieces;
			return $this;
		}

		public function getSkill(): SkillRank {
			return $this->skill;
		}

		public function setSkill(SkillRank $skill): static {
			$this->skill = $skill;
			return $this;
		}
	}