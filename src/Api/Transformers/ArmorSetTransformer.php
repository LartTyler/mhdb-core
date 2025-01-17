<?php
	namespace App\Api\Transformers;

	use App\Api\Models\ArmorSetModel;
	use App\Entity\ArmorSet;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<ArmorSetModel, ArmorSet>
	 */
	class ArmorSetTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new ArmorSet($data->name);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if ($data->exists('name'))
				$entity->setName($data->name);

			if (isset($data->pieces)) {
				$entity->getPieces()->clear();

				foreach ($data->pieces as $piece) {
					$piece->setArmorSet($entity);
					$entity->getPieces()->add($piece);
				}
			}

			if ($data->exists('bonus'))
				$entity->setBonus($data->bonus);
		}
	}