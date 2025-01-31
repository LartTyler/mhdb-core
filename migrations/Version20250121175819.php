<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250121175819 extends AbstractMigration {
		public function getDescription(): string {
			return 'Allow armor elemental resists to be negative';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE armors CHANGE resist_fire resist_fire INT NOT NULL, CHANGE resist_water resist_water INT NOT NULL, CHANGE resist_ice resist_ice INT NOT NULL, CHANGE resist_thunder resist_thunder INT NOT NULL, CHANGE resist_dragon resist_dragon INT NOT NULL');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE armors CHANGE resist_fire resist_fire INT UNSIGNED NOT NULL, CHANGE resist_water resist_water INT UNSIGNED NOT NULL, CHANGE resist_ice resist_ice INT UNSIGNED NOT NULL, CHANGE resist_thunder resist_thunder INT UNSIGNED NOT NULL, CHANGE resist_dragon resist_dragon INT UNSIGNED NOT NULL');
			// @formatter:on
		}
	}
