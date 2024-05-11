<?php
	namespace App\Api\Transformers;

	use App\Api\Models\CampModel;
	use App\Entity\Camp;
	use DaybreakStudios\Rest\Transformer\AbstractTransformer;
	use DaybreakStudios\Rest\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\Rest\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	class CampTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			assert($data instanceof CampModel);
			return new Camp($data->location, $data->name, $data->zone);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			assert($data instanceof CampModel);
			assert($entity instanceof Camp);

			if (isset($data->name))
				$entity->setName($data->name);

			if (isset($data->zone))
				$entity->setZone($data->zone);
		}
	}
