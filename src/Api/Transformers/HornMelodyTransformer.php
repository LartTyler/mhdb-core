<?php
	namespace App\Api\Transformers;

	use App\Api\Models\HornMelodyModel;
	use App\Entity\HornMelody;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	/**
	 * @extends AbstractTransformer<HornMelodyModel, HornMelody>
	 */
	class HornMelodyTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			return new HornMelody($data->notes);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			if (isset($data->notes))
				$entity->setNotes($data->notes);
		}

		protected function getShouldUpdateAfterCreate(): bool {
			return false;
		}
	}
