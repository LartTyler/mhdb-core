<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250115230353 extends AbstractMigration {
		public function getDescription(): string {
			return 'Make item string fields nullable';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE items CHANGE name name VARCHAR(64) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE items CHANGE name name VARCHAR(64) NOT NULL, CHANGE description description LONGTEXT NOT NULL');
			// @formatter:on
		}
	}
