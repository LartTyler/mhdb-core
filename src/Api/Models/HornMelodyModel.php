<?php
	namespace App\Api\Models;

	use App\Game\Note;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class HornMelodyModel {
		/**
		 * @var Note[]
		 */
		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\Count(exactly: 3)]
		#[Assert\All([
			new Assert\NotNull(),
			new Assert\Type(Note::class),
		])]
		public array $notes;
	}
