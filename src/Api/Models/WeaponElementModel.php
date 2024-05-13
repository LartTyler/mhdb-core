<?php
	namespace App\Api\Models;

	use App\Game\Element;
	use Symfony\Component\Validator\Constraints as Assert;

	class WeaponElementModel extends WeaponSpecialModel {
		#[Assert\NotNull]
		public Element $element;
	}
