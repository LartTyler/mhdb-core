<?php
	namespace App\Api\Transformers;

	use App\Api\Models\DecorationModel;
	use App\Entity\Decoration;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<Decoration, DecorationModel>
	 */
	class DecorationTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new Decoration($data->name, $data->slot, $data->rarity);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if ($data->exists('name'))
				$entity->setName($data->name);

			if (isset($data->slot))
				$entity->setSlot($data->slot);

			if (isset($data->rarity))
				$entity->setRarity($data->rarity);

			if (isset($data->skills)) {
				$entity->getSkills()->clear();

				foreach ($data->skills as $skill)
					$entity->getSkills()->add($skill);
			}
		}
	}