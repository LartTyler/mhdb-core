<?php
	namespace App\Api\Transformers;

	use App\Api\Models\LocationModel;
	use App\Entity\Location;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	/**
	 * @extends AbstractTransformer<Location, LocationModel>
	 */
	class LocationTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			return new Location($data->name, $data->zoneCount);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			if (isset($data->name))
				$entity->setName($data->name);

			if (isset($data->zoneCount))
				$entity->setZoneCount($data->zoneCount);
		}

		protected function getShouldUpdateAfterCreate(): bool {
			return false;
		}
	}
