<?php
	namespace App\Api;

	use App\Security\FirewallRole;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;

	#[\Attribute(\Attribute::TARGET_CLASS)]
	class AsCrudEntity {
		public const METHOD_LIST = 'list';
		public const METHOD_CREATE = 'create';
		public const METHOD_READ = 'read';
		public const METHOD_UPDATE = 'update';
		public const METHOD_DELETE = 'delete';

		public array $methods;

		public function __construct(
			public string $basePath,
			array|string|null $method = null,
			public $firewallRole = FirewallRole::USER,
			public ?string $transformer = null,
			public ?string $dtoClass = null,
			public ?array $strict = null,
		) {
			if (is_string($method))
				$this->methods = [$method];
			else
				$this->methods = $method ?? [];
		}

		public function isList(): bool {
			return $this->hasMethod(self::METHOD_LIST);
		}

		public function isCreate(): bool {
			return $this->hasMethod(self::METHOD_CREATE);
		}

		public function isRead(): bool {
			return $this->hasMethod(self::METHOD_READ);
		}

		public function isUpdate(): bool {
			return $this->hasMethod(self::METHOD_UPDATE);
		}

		public function isDelete(): bool {
			return $this->hasMethod(self::METHOD_DELETE);
		}

		protected function hasMethod(string $method): bool {
			return !$this->methods || in_array($method, $this->methods);
		}

		public static function getInstance(string $class): ?static {
			if (!class_exists($class) || !is_a($class, EntityInterface::class, true))
				return null;

			$refl = new \ReflectionClass($class);
			$attr = $refl->getAttributes(static::class, \ReflectionAttribute::IS_INSTANCEOF)[0] ?? null;

			if (!$attr)
				return null;

			return $attr->newInstance();
		}

		public static function getEntityPrefix(string $class): string {
			return strtolower(substr($class, strrpos($class, '\\') + 1));
		}

		public static function getEntityControllerName(string $class): string {
			return 'app.crud.' . static::getEntityPrefix($class);
		}
	}
