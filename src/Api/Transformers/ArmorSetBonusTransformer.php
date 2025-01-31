<?php
	namespace App\Api\Transformers;

	use App\Api\Models\ArmorSetBonusModel;
	use App\Entity\ArmorSetBonus;
	use App\Entity\ArmorSetBonusRank;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<ArmorSetBonus, ArmorSetBonusModel>
	 */
	class ArmorSetBonusTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new ArmorSetBonus($data->name);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if ($data->exists('name'))
				$entity->setName($data->name);

			if (isset($data->ranks)) {
				$entity->getRanks()->clear();

				foreach ($data->ranks as $rank)
					$entity->getRanks()->add(new ArmorSetBonusRank($entity, $rank->pieces, $rank->skill));
			}
		}
	}