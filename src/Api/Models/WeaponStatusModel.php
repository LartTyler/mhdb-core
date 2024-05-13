<?php
	namespace App\Api\Models;

	use App\Game\Status;
	use Symfony\Component\Validator\Constraints as Assert;

	class WeaponStatusModel extends WeaponSpecialModel {
		#[Assert\NotNull]
		public Status $status;
	}
