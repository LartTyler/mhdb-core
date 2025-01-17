<?php
	namespace App\Api\Models;

	use App\Game\Status;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class MonsterStatusResistanceModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Status $status;
	}