<?php
	namespace App\Repository;

	use App\Entity\User;
	use Doctrine\ORM\EntityRepository;

	class UserRepository extends EntityRepository {
		public function findByEmailAddress(string $emailAddress): ?User {
			return $this->findOneBy(
				[
					'emailAddress' => $emailAddress,
				],
			);
		}
	}
