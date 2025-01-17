<?php
	namespace App\Api\Transformers;

	use App\Api\Models\MonsterElementWeaknessModel;
	use App\Api\Models\MonsterStatusWeaknessModel;
	use App\Api\Models\MonsterWeaknessModel;
	use App\Entity\MonsterElementWeakness;
	use App\Entity\MonsterStatusWeakness;
	use App\Entity\MonsterWeakness;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<MonsterWeaknessModel, MonsterWeakness>
	 */
	class MonsterWeaknessTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;
		use DependentTypesTrait;

		protected function doCreate(object $data): Entity {
			return match (true) {
				$data instanceof MonsterElementWeaknessModel => new MonsterElementWeakness(
					$data->monster,
					$data->level,
					$data->element,
				),
				$data instanceof MonsterStatusWeaknessModel => new MonsterStatusWeakness(
					$data->monster,
					$data->level,
					$data->status,
				),
				default => throw new \InvalidArgumentException('Cannot transform ' . $data::class),
			};
		}

		protected function doUpdate(object $data, Entity $entity): void {
			$this->throwIfTypeMismatch($this->validator, $data->kind, $entity->getKind());

			if (isset($data->level))
				$entity->setLevel($data->level);

			if ($data->exists('condition'))
				$entity->setCondition($data->condition);

			if ($entity instanceof MonsterElementWeakness) {
				assert($data instanceof MonsterElementWeaknessModel);

				if (isset($data->element))
					$entity->setElement($data->element);
			} else if ($entity instanceof MonsterStatusWeakness) {
				assert($data instanceof MonsterStatusWeaknessModel);

				if (isset($data->status))
					$entity->setStatus($data->status);
			} else
				throw new \InvalidArgumentException('Cannot transform ' . $entity::class);
		}
	}