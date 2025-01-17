<?php
	namespace App\Api\Transformers;

	use App\Api\Models\AilmentModel;
	use App\Api\Models\AilmentProtectionModel;
	use App\Api\Models\AilmentRecoveryModel;
	use App\Entity\Ailment;
	use App\Entity\AilmentProtection;
	use App\Entity\AilmentRecovery;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<AilmentModel, Ailment>
	 */
	class AilmentTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new Ailment($data->name);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if ($data->exists('name'))
				$entity->setName($data->name);

			if ($data->exists('description'))
				$entity->setDescription($data->description);

			if (isset($data->recovery))
				$this->doUpdateRecovery($entity->getRecovery(), $data->recovery);

			if (isset($data->protection))
				$this->doUpdateProtection($entity->getProtection(), $data->protection);
		}

		protected function doUpdateRecovery(AilmentRecovery $recovery, AilmentRecoveryModel $data): void {
			if (isset($data->items)) {
				$recovery->getItems()->clear();

				foreach ($data->items as $item)
					$recovery->getItems()->add($item);
			}

			if (isset($data->actions))
				$recovery->setActions($data->actions);
		}

		protected function doUpdateProtection(AilmentProtection $protection, AilmentProtectionModel $data): void {
			if (isset($data->skills)) {
				$protection->getSkills()->clear();

				foreach ($data->skills as $skill)
					$protection->getSkills()->add($skill);
			}

			if (isset($data->items)) {
				$protection->getItems()->clear();

				foreach ($data->items as $item)
					$protection->getItems()->add($item);
			}
		}
	}