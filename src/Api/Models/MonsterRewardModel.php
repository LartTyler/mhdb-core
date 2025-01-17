<?php
	namespace App\Api\Models;

	use App\Entity\Item;
	use App\Entity\Monster;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class MonsterRewardModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Monster $monster;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Item $item;
	}