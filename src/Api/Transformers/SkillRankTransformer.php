<?php
	namespace App\Api\Transformers;

	use App\Api\Models\SkillRankModel;
	use App\Entity\SkillRank;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	/**
	 * @extends AbstractTransformer<SkillRankModel, SkillRank>
	 */
	class SkillRankTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			return new SkillRank($data->skill, $data->level);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			if (isset($data->level))
				$entity->setLevel($data->level);

			if (isset($data->description))
				$entity->setDescription($data->description);
		}
	}
