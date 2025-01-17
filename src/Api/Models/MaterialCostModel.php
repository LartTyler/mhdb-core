<?php
	namespace App\Api\Models;

	use App\Entity\Item;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class MaterialCostModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Item $item;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public int $quantity;
	}