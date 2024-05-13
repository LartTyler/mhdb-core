<?php
	namespace App\Api;

	class EntityLocator implements \IteratorAggregate {
		public function __construct(
			protected string $basePath,
		) {}

		public function getIterator(): \Generator {
			$dirs = new \RecursiveDirectoryIterator($this->basePath, \FilesystemIterator::CURRENT_AS_PATHNAME);

			$recurse = new \RecursiveIteratorIterator($dirs);
			$iter = new \RegexIterator($recurse, '/\.php$/');

			$baseNamespace = 'App\\Entity\\';

			foreach ($iter as $item) {
				$ns = $baseNamespace;
				$path = $item;

				while (($dir = basename($path = dirname($path))) !== 'Entity')
					$ns .= $dir . '\\';

				yield $ns . basename($item, '.php');
			}
		}
	}
