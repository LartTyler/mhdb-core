<?php
	namespace App\Api\Transformers;

	use App\Api\Models\WeaponCraftingModel;
	use App\Entity\MaterialCost;
	use App\Entity\WeaponCrafting;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	/**
	 * @extends AbstractTransformer<WeaponCraftingModel, WeaponCrafting>
	 */
	class WeaponCraftingTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			$crafting = new WeaponCrafting($data->weapon, $data->craftable, $data->previous ?? null);
			$data->weapon->setCrafting($crafting);

			return $crafting;
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			if ($data->exists('previous'))
				$entity->setPrevious($data->previous);

			if (isset($data->craftable))
				$entity->setCraftable($data->craftable);

			if (isset($data->branches)) {
				$entity->getBranches()->clear();

				foreach ($data->branches as $branch)
					$entity->getBranches()->add($branch);
			}

			if (isset($data->craftingMaterials)) {
				$entity->getCraftingMaterials()->clear();

				foreach ($data->craftingMaterials as $cost) {
					$material = new MaterialCost($cost->item, $cost->quantity);
					$entity->getCraftingMaterials()->add($material);
				}
			}

			if (isset($data->craftingZennyCost))
				$entity->setCraftingZennyCost($data->craftingZennyCost);

			if (isset($data->upgradeMaterials)) {
				$entity->getUpgradeMaterials()->clear();

				foreach ($data->upgradeMaterials as $cost) {
					$material = new MaterialCost($cost->item, $cost->quantity);
					$entity->getUpgradeMaterials()->add($material);
				}
			}

			if (isset($data->upgradeZennyCost))
				$entity->setUpgradeZennyCost($data->upgradeZennyCost);
		}
	}