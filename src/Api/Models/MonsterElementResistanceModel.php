<?php
	namespace App\Api\Models;

	use App\Game\Element;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class MonsterElementResistanceModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		public Element $element;
	}