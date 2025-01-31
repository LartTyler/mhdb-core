<?php
	namespace App\Api\Transformers;

	use App\Api\Models\MonsterModel;
	use App\Entity\Monster;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<Monster, MonsterModel>
	 */
	class MonsterTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new Monster($data->kind, $data->species, $data->name);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if (isset($data->kind))
				$entity->setKind($data->kind);

			if (isset($data->species))
				$entity->setSpecies($data->species);

			if ($data->exists('name'))
				$entity->setName($data->name);

			if ($data->exists('description'))
				$entity->setDescription($data->description);

			if (isset($data->ailments)) {
				$entity->getAilments()->clear();

				foreach ($data->ailments as $ailment)
					$entity->getAilments()->add($ailment);
			}

			if (isset($data->locations)) {
				$entity->getLocations()->clear();

				foreach ($data->locations as $location)
					$entity->getLocations()->add($location);
			}

			if (isset($data->elements))
				$entity->setElements($data->elements);
		}
	}