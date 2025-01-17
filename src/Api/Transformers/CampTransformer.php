<?php
	namespace App\Api\Transformers;

	use App\Api\Models\CampModel;
	use App\Entity\Camp;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	/**
	 * @extends AbstractTransformer<CampModel, Camp>
	 */
	class CampTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			return new Camp($data->location, $data->name, $data->zone);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			if (isset($data->name))
				$entity->setName($data->name);

			if (isset($data->zone))
				$entity->setZone($data->zone);
		}

		protected function getShouldUpdateAfterCreate(): bool {
			return false;
		}
	}
