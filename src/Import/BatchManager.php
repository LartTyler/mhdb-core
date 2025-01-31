<?php
	namespace App\Import;

	use Doctrine\ORM\EntityManagerInterface;

	class BatchManager {
		protected int $counter = 0;

		public function __construct(
			protected EntityManagerInterface $entityManager,
			protected int $batchSize,
		) {}

		public function isBatchingEnabled(): bool {
			return $this->batchSize > 0;
		}

		public function increment(int $amount = 1): void {
			$this->counter += $amount;

			if ($this->isBatchingEnabled() && $this->counter >= $this->batchSize)
				$this->dispatch();
		}

		public function dispatch(): void {
			$this->entityManager->flush();
			$this->entityManager->clear();

			$this->counter = 0;
		}
	}