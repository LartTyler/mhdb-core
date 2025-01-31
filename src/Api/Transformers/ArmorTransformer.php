<?php
	namespace App\Api\Transformers;

	use App\Api\Models\ArmorModel;
	use App\Entity\Armor;
	use DaybreakStudios\RestBundle\Transformer\AbstractTransformer;
	use DaybreakStudios\RestBundle\Transformer\Traits\CloneNotSupportedTrait;
	use DaybreakStudios\RestBundle\Transformer\Traits\StubDeleteTrait;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	/**
	 * @extends AbstractTransformer<Armor, ArmorModel>
	 */
	class ArmorTransformer extends AbstractTransformer {
		use StubDeleteTrait;
		use CloneNotSupportedTrait;

		protected function doCreate(object $data): EntityInterface {
			return new Armor($data->kind, $data->rank, $data->rarity, $data->name);
		}

		protected function doUpdate(object $data, EntityInterface $entity): void {
			if (isset($data->rank))
				$entity->setRank($data->rank);

			if (isset($data->rarity))
				$entity->setRarity($data->rarity);

			if ($data->exists('name'))
				$entity->setName($data->name);

			if (isset($data->skills)) {
				$entity->getSkills()->clear();

				foreach ($data->skills as $skill)
					$entity->getSkills()->add($skill);
			}

			if (isset($data->slots))
				$entity->setSlots($data->slots);

			if ($data->exists('armorSet'))
				$entity->setArmorSet($data->armorSet);

			if (isset($data->resistances)) {
				$input = $data->resistances;
				$actual = $entity->getResistances();

				if (isset($input->fire))
					$actual->setFire($input->fire);

				if (isset($input->water))
					$actual->setWater($input->water);

				if (isset($input->ice))
					$actual->setIce($input->ice);

				if (isset($input->thunder))
					$actual->setThunder($input->thunder);

				if (isset($input->dragon))
					$actual->setDragon($input->dragon);
			}

			if (isset($data->defense)) {
				$input = $data->defense;
				$actual = $entity->getDefense();

				if (isset($input->base))
					$actual->setBase($input->base);

				if (isset($input->max))
					$actual->setMax($input->max);

				if (isset($input->augmented))
					$actual->setAugmented($input->augmented);
			}
		}
	}