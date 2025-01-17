<?php
	namespace App\Api\Transformers;

	use App\Api\Models\CharmRankCraftingModel;
	use App\Entity\CharmRankCrafting;
	use App\Entity\MaterialCost;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<CharmRankCraftingModel, CharmRankCrafting>
	 */
	class CharmRankCraftingTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new CharmRankCrafting($data->charmRank, $data->craftable);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if (isset($data->craftable))
				$entity->setCraftable($data->craftable);

			if (isset($data->zennyCost))
				$entity->setZennyCost($data->zennyCost);

			if (isset($data->materials)) {
				$entity->getMaterials()->clear();

				foreach ($data->materials as $material)
					$entity->getMaterials()->add(new MaterialCost($material->item, $material->quantity));
			}
		}
	}