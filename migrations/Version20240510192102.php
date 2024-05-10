<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	/**
	 * Auto-generated Migration: Please modify to your needs!
	 */
	final class Version20240510192102 extends AbstractMigration {
		public function getDescription(): string {
			return 'Make melody_id column nullable';
		}

		public function up(Schema $schema): void {
			// this up() migration is auto-generated, please modify it to your needs
			$this->addSql('ALTER TABLE weapons CHANGE melody_id melody_id INT UNSIGNED DEFAULT NULL');
		}

		public function down(Schema $schema): void {
			// this down() migration is auto-generated, please modify it to your needs
			$this->addSql('ALTER TABLE weapons CHANGE melody_id melody_id INT UNSIGNED NOT NULL');
		}
	}
