<?php
	namespace App\DataFixtures;

	use App\Entity\Weapon;
	use App\Entity\WeaponElement;
	use App\Entity\Weapons\ChargeBlade;
	use App\Game\ChargeBladePhial;
	use App\Game\DamageKind;
	use App\Game\Elderseal;
	use App\Game\Element;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;

	class WeaponFixtures extends Fixture {
		public function load(ObjectManager $manager): void {
			$cb1 = new ChargeBlade('Test CB I', 1, DamageKind::Severing, ChargeBladePhial::Element);
			$cb1->getSpecials()->add($this->createWeaponElement($cb1, Element::Thunder, 50, 100));
			$manager->persist($cb1);

			$cb2 = (new ChargeBlade('Test CB II', 2, DamageKind::Severing, ChargeBladePhial::Element))->setAffinity(10);
			$cb2->getSpecials()->add($this->createWeaponElement($cb2, Element::Thunder, 75, 150));
			$manager->persist($cb2);

			$cb3 = (new ChargeBlade('Test CB III', 3, DamageKind::Severing, ChargeBladePhial::Element))
				->setAffinity(20)
				->setElderseal(Elderseal::Low);

			$cb3->getSpecials()->add($this->createWeaponElement($cb3, Element::Thunder, 150, 300));
			$manager->persist($cb3);

			$manager->flush();
		}

		protected function createWeaponElement(
			Weapon $weapon,
			Element $element,
			int $raw,
			int $display,
		): WeaponElement {
			$element = new WeaponElement($weapon, $element);
			$element
				->getDamage()
				->setRaw($raw)
				->setDisplay($display);

			return $element;
		}
	}
