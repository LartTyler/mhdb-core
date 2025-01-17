<?php
	namespace App\Api\Models;

	use App\Entity\Item;
	use App\Entity\Skill;

	class AilmentProtectionModel {
		/**
		 * @var Skill[]
		 */
		public array $skills;

		/**
		 * @var Item[]
		 */
		public array $items;
	}