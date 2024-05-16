<?php
	namespace App\Api\Transformers;

	use App\Api\Models\LocationModel;
	use App\Entity\Location;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	class LocationTransformer extends AbstractTransformer {
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			assert($data instanceof LocationModel);
			return new Location($data->name, $data->zoneCount);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			assert($data instanceof LocationModel);
			assert($entity instanceof Location);

			if (isset($data->name))
				$entity->setName($data->name);

			if (isset($data->zoneCount))
				$entity->setZoneCount($data->zoneCount);
		}

		protected function doDelete(EntityInterface $entity): void {
			// noop
		}
	}
