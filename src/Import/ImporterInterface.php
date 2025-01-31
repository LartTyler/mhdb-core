<?php
	namespace App\Import;

	interface ImporterInterface {
		public function import(ImportContext $context): void;
	}