<?php
	namespace App\Import;

	#[\Attribute(\Attribute::TARGET_CLASS)]
	class AsImporter {
		public const TAG = 'mhdb_core.importer';

		public function __construct(
			public int $priority = 0,
		) {}
	}