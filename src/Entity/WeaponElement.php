<?php
	namespace App\Entity;

	use App\Game\Element;
	use App\Game\WeaponSpecialKind;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class WeaponElement extends WeaponSpecial {
		protected WeaponSpecialKind $kind = WeaponSpecialKind::Element;

		#[ORM\Column(enumType: Element::class)]
		private Element $element;

		public function __construct(Weapon $weapon, Element $element, bool $hidden = false) {
			parent::__construct($weapon, $hidden);
			$this->element = $element;
		}

		public function getElement(): Element {
			return $this->element;
		}

		public function setElement(Element $element): static {
			$this->element = $element;
			return $this;
		}
	}
