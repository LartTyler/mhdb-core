<?php
	namespace App\Entity;

	use App\Game\Element;
	use Doctrine\ORM\Mapping as ORM;

	#[ORM\Entity]
	class MonsterElementResistance extends MonsterResistance {
		protected string $kind = self::KIND_ELEMENT;

		#[ORM\Column(enumType: Element::class)]
		private Element $element;

		public function __construct(Monster $monster, Element $element) {
			parent::__construct($monster);
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