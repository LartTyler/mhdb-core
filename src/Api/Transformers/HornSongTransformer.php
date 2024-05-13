<?php
	namespace App\Api\Transformers;

	use App\Api\Models\HornSongModel;
	use App\Entity\HornSong;
	use DaybreakStudios\Rest\Transformer\AbstractTransformer;
	use DaybreakStudios\Rest\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\Rest\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	class HornSongTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			assert($data instanceof HornSongModel);
			return new HornSong($data->melody, $data->sequence, $data->duration, $data->effects);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			assert($data instanceof HornSongModel);
			assert($entity instanceof HornSong);

			if (isset($data->sequence))
				$entity->setSequence($data->sequence);

			if (isset($data->duration))
				$entity->setDuration($data->duration);

			if (isset($data->effects))
				$entity->setEffects($data->effects);

			if (isset($data->personal))
				$entity->setPersonal($data->personal);
		}
	}
