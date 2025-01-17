<?php
	namespace App\Api\Transformers;

	use App\Api\Models\CharmRankModel;
	use App\Entity\CharmRank;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface as Entity;

	/**
	 * @extends AbstractTransformer<CharmRankModel, CharmRank>
	 */
	class CharmRankTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): Entity {
			return new CharmRank($data->charm, $data->name, $data->level, $data->rarity);
		}

		protected function doUpdate(object $data, Entity $entity): void {
			if ($data->exists('name'))
				$entity->setName($data->name);

			if (isset($data->level))
				$entity->setLevel($data->level);

			if (isset($data->rarity))
				$entity->setRarity($data->rarity);

			if (isset($data->skills)) {
				$entity->getSkills()->clear();

				foreach ($data->skills as $skill)
					$entity->getSkills()->add($skill);
			}
		}
	}