<?php
	namespace App\Import;

	class ImportException extends \RuntimeException {
		public static function notFound(
			string $relatedObjectName,
			string $lookupField,
			string $lookupValue,
			string $whileImporting,
		): static {
			return new static(
				sprintf(
					'Could not find %s with %s "%s" while importing %s',
					$relatedObjectName,
					$lookupField,
					$lookupValue,
					$whileImporting,
				),
			);
		}
	}