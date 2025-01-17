<?php
	namespace App\Api\Transformers;

	use App\Api\Models\MonsterElementResistanceModel;
	use App\Api\Models\MonsterResistanceModel;
	use App\Api\Models\MonsterStatusResistanceModel;
	use App\Entity\MonsterElementResistance;
	use App\Entity\MonsterResistance;
	use App\Entity\MonsterStatusResistance;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<MonsterResistanceModel, MonsterResistance>
	 */
	class MonsterResistanceTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;
		use DependentTypesTrait;

		protected function doCreate(object $data): Entity {
			return match (true) {
				$data instanceof MonsterElementResistanceModel => new MonsterElementResistance(
					$data->monster,
					$data->element,
				),
				$data instanceof MonsterStatusResistanceModel => new MonsterStatusResistance(
					$data->monster,
					$data->status,
				),
				default => throw new \InvalidArgumentException('Cannot transform ' . $data::class),
			};
		}

		protected function doUpdate(object $data, Entity $entity): void {
			$this->throwIfTypeMismatch($this->validator, $data->kind, $entity->getKind());

			if ($data->exists('condition'))
				$entity->setCondition($data->condition);

			if ($entity instanceof MonsterElementResistance) {
				assert($data instanceof MonsterElementResistanceModel);

				if (isset($data->element))
					$entity->setElement($data->element);
			} else if ($entity instanceof MonsterStatusResistance) {
				assert($data instanceof MonsterStatusResistanceModel);

				if (isset($data->status))
					$entity->setStatus($data->status);
			} else
				throw new \InvalidArgumentException('Cannot transform ' . $entity::class);
		}
	}