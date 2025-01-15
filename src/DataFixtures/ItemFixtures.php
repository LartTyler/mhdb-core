<?php
	namespace App\DataFixtures;

	use App\Entity\Item;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;

	class ItemFixtures extends Fixture {
		public function load(ObjectManager $manager): void {
			$manager->persist(new Item('Item 1', 1));
			$manager->persist(new Item('Item 2', 2));

			$manager->flush();
		}
	}