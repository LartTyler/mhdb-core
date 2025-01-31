<?php
	namespace App\Import;

	use Symfony\Component\Serializer\SerializerInterface;

	/**
	 * @template T of object
	 */
	class CsvReader implements \Iterator {
		/**
		 * @var resource
		 */
		protected $handle;

		protected string $type;

		protected string $headers;

		protected ?string $current;

		protected int $index = 0;

		/**
		 * @param SerializerInterface $serializer
		 * @param class-string<T>     $type
		 * @param string              $path
		 * @param array               $serializerContext
		 */
		public function __construct(
			protected SerializerInterface $serializer,
			string $type,
			string $path,
			protected array $serializerContext = [],
		) {
			$this->handle = fopen($path, 'r');
			$this->type = $type . '[]';

			$this->headers = fgets($this->handle);
			$this->current = fgets($this->handle) ?: null;
		}

		/**
		 * @return T|null
		 */
		public function current(): mixed {
			if (!$this->current)
				return null;

			return $this->serializer->deserialize(
				$this->headers . $this->current,
				$this->type,
				'csv',
				$this->serializerContext,
			)[0];
		}

		public function next(): void {
			$this->current = fgets($this->handle) ?: null;
			$this->index += 1;
		}

		public function key(): int {
			return $this->index;
		}

		public function valid(): bool {
			return $this->current !== null;
		}

		public function rewind(): void {
			// Ignored
		}
	}