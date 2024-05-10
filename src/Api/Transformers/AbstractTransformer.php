<?php
	namespace App\Api\Transformers;

	use App\I18n\TranslatableEntityInterface;
	use DaybreakStudios\Rest\Transformer\AbstractTransformer as Base;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\HttpFoundation\RequestStack;
	use Symfony\Component\Validator\Validator\ValidatorInterface;

	abstract class AbstractTransformer extends Base {
		public function __construct(
			EntityManagerInterface $entityManager,
			protected RequestStack $requestStack,
			?ValidatorInterface $validator = null,
		) {
			parent::__construct($entityManager, $validator);
		}

		public function create(object $data, bool $skipValidation = false): EntityInterface {
			$entity = parent::create($data, $skipValidation);

			if ($entity instanceof TranslatableEntityInterface)
				$entity->setTranslatableLocale($this->getCurrentLocale());

			return $entity;
		}

		public function update(object $data, EntityInterface $entity, bool $skipValidation = false): void {
			if ($entity instanceof TranslatableEntityInterface)
				$entity->setTranslatableLocale($this->getCurrentLocale());

			parent::update($data, $entity, $skipValidation);
		}

		public function clone(EntityInterface $original, object $data = null): EntityInterface {
			if ($original instanceof TranslatableEntityInterface)
				$original->setTranslatableLocale($this->getCurrentLocale());

			return parent::clone($original, $data);
		}

		private function getCurrentLocale(): string {
			return $this->requestStack->getCurrentRequest()->getLocale();
		}
	}
