<?php
	namespace App\Api\Transformers;

	use DaybreakStudios\RestBundle\Transformer\Exceptions\ConstraintViolationException;
	use Symfony\Component\Validator\Constraints\EqualTo;
	use Symfony\Component\Validator\Validator\ValidatorInterface;

	trait DependentTypesTrait {
		protected function throwIfTypeMismatch(
			ValidatorInterface $validator,
			mixed $modelType,
			mixed $entityType,
			string $propertyPath = 'kind',
			string $message = 'Cannot update object using a payload of a different type (expected {{ compared_value }}).',
		): void {
			$errors = $validator->validate(
				$modelType,
				[
					new EqualTo(
						$entityType,
						propertyPath: $propertyPath,
						message: $message,
					),
				],
			);

			if ($errors->count() > 0)
				throw new ConstraintViolationException($errors);
		}
	}