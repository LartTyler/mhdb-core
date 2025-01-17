<?php
	namespace App\Api\Transformers;

	use App\Api\Models\SkillModel;
	use App\Entity\Skill;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	/**
	 * @extends AbstractTransformer<SkillModel, Skill>
	 */
	class SkillTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			return new Skill($data->name);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			if (isset($data->name))
				$entity->setName($data->name);

			if (isset($data->description))
				$entity->setDescription($data->description);
		}
	}
