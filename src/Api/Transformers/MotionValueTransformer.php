<?php
	namespace App\Api\Transformers;

	use App\Api\Models\MotionValueModel;
	use App\Entity\MotionValue;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<MotionValue, MotionValueModel>
	 */
	class MotionValueTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new MotionValue($data->weapon, $data->name, $data->damage);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if ($data->exists('name'))
				$entity->setName($data->name);

			if (isset($data->weapon))
				$entity->setWeapon($data->weapon);

			if (isset($data->damage))
				$entity->setDamage($data->damage);

			if (isset($data->stun))
				$entity->setStun($data->stun);

			if (isset($data->exhaust))
				$entity->setExhaust($data->exhaust);

			if (isset($data->hits))
				$entity->setHits($data->hits);
		}
	}