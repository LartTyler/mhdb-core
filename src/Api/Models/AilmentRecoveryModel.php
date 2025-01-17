<?php
	namespace App\Api\Models;

	use App\Entity\Item;
	use Symfony\Component\Validator\Constraints as Assert;

	class AilmentRecoveryModel {
		/**
		 * @var Item[]
		 */
		public array $items;

		/**
		 * @var string[]
		 */
		#[Assert\All([
			new Assert\Type('string'),
			new Assert\NotBlank(),
		])]
		public array $actions;
	}