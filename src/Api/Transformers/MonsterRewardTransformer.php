<?php
	namespace App\Api\Transformers;

	use App\Api\Models\MonsterRewardModel;
	use App\Entity\MonsterReward;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<MonsterRewardModel, MonsterReward>
	 */
	class MonsterRewardTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new MonsterReward($data->monster, $data->item);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if (isset($data->item))
				$entity->setItem($data->item);
		}

		protected function getShouldUpdateAfterCreate(): bool {
			return false;
		}
	}