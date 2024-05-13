<?php
	namespace App\Entity;

	use App\Game\Status;
	use App\Game\WeaponSpecialKind;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class WeaponStatus extends WeaponSpecial {
		protected WeaponSpecialKind $kind = WeaponSpecialKind::Status;

		#[ORM\Column(enumType: Status::class)]
		private Status $status;

		public function __construct(Weapon $weapon, Status $status, bool $hidden = false) {
			parent::__construct($weapon, $hidden);
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
