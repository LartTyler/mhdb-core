<?php
	namespace App\Api\Transformers;

	use App\Api\Models\MonsterRewardConditionModel;
	use App\Entity\MonsterRewardCondition;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<MonsterRewardCondition, MonsterRewardConditionModel>
	 */
	class MonsterRewardConditionTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new MonsterRewardCondition($data->reward, $data->kind, $data->rank, $data->quantity, $data->chance);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if (isset($data->kind))
				$entity->setKind($data->kind);

			if (isset($data->rank))
				$entity->setRank($data->rank);

			if (isset($data->quantity))
				$entity->setQuantity($data->quantity);

			if (isset($data->chance))
				$entity->setChance($data->chance);

			if ($data->exists('subtype'))
				$entity->setSubtype($data->subtype);
		}
	}