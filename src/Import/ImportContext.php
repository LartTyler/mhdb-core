<?php
	namespace App\Import;

	readonly class ImportContext {
		public function __construct(
			public BatchManager $batch,
			public string $basePath,
		) {}
	}