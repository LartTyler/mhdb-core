<?php
	namespace App\Api\Transformers;

	use App\Api\Models\HornMelodyModel;
	use App\Entity\HornMelody;
	use DaybreakStudios\Rest\Transformer\AbstractTransformer;
	use DaybreakStudios\Rest\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\Rest\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	class HornMelodyTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			assert($data instanceof HornMelodyModel);
			return new HornMelody($data->notes);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			assert($data instanceof HornMelodyModel);
			assert($entity instanceof HornMelody);

			if (isset($data->notes))
				$entity->setNotes($data->notes);
		}
	}
