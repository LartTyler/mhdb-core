<?php
	namespace App\Api\Transformers;

	use App\Api\Models\SkillModel;
	use App\Entity\Skill;
	use DaybreakStudios\Rest\Transformer\AbstractTransformer;
	use DaybreakStudios\Rest\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\Rest\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	class SkillTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			assert($data instanceof SkillModel);
			return new Skill($data->name);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			assert($data instanceof SkillModel);
			assert($entity instanceof Skill);

			if (isset($data->name))
				$entity->setName($data->name);

			if (isset($data->description))
				$entity->setDescription($data->description);
		}
	}
