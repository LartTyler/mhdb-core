<?php
	namespace App\Entity;

	use App\Game\Status;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class MonsterStatusWeakness extends MonsterWeakness {
		protected string $kind = self::KIND_STATUS;

		#[ORM\Column(enumType: Status::class)]
		private Status $status;

		public function __construct(Monster $monster, int $level, Status $status) {
			parent::__construct($monster, $level);
			$this->status = $status;
		}

		public function getStatus(): Status {
			return $this->status;
		}

		public function setStatus(Status $status): static {
			$this->status = $status;
			return $this;
		}
	}