<?php
	namespace App\Entity;

	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Embeddable]
	class ArmorElementResistances {
		#[ORM\Column(options: ['unsigned' => true])]
		private int $fire = 0;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $water = 0;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $ice = 0;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $thunder = 0;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $dragon = 0;

		public function getFire(): int {
			return $this->fire;
		}

		public function setFire(int $fire): static {
			$this->fire = $fire;
			return $this;
		}

		public function getWater(): int {
			return $this->water;
		}

		public function setWater(int $water): static {
			$this->water = $water;
			return $this;
		}

		public function getIce(): int {
			return $this->ice;
		}

		public function setIce(int $ice): static {
			$this->ice = $ice;
			return $this;
		}

		public function getThunder(): int {
			return $this->thunder;
		}

		public function setThunder(int $thunder): static {
			$this->thunder = $thunder;
			return $this;
		}

		public function getDragon(): int {
			return $this->dragon;
		}

		public function setDragon(int $dragon): static {
			$this->dragon = $dragon;
			return $this;
		}
	}