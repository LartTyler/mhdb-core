<?php
	namespace App\Api\Transformers;

	use App\Api\Models\ArmorCraftingModel;
	use App\Entity\ArmorCrafting;
	use App\Entity\MaterialCost;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<ArmorCrafting, ArmorCraftingModel>
	 */
	class ArmorCraftingTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new ArmorCrafting($data->armor);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if (isset($data->materials)) {
				$entity->getMaterials()->clear();

				foreach ($data->materials as $material) {
					$cost = new MaterialCost($material->item, $material->quantity);
					$entity->getMaterials()->add($cost);
				}
			}

			if (isset($data->zennyCost))
				$entity->setZennyCost($data->zennyCost);
		}
	}