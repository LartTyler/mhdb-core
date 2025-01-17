<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250117175116 extends AbstractMigration {
		public function getDescription(): string {
			return 'Add ailment entities';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('CREATE TABLE ailment_protections (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ailment_id INT UNSIGNED DEFAULT NULL, UNIQUE INDEX UNIQ_6630DD52432CD43A (ailment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE ailment_protection_skills (ailment_protection_id INT UNSIGNED NOT NULL, skill_id INT UNSIGNED NOT NULL, INDEX IDX_517E18BFFE812F5B (ailment_protection_id), INDEX IDX_517E18BF5585C142 (skill_id), PRIMARY KEY(ailment_protection_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE ailment_protection_item (ailment_protection_items INT UNSIGNED NOT NULL, item_id INT UNSIGNED NOT NULL, INDEX IDX_84E874CF1051F85E (ailment_protection_items), INDEX IDX_84E874CF126F525E (item_id), PRIMARY KEY(ailment_protection_items, item_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE ailment_recoveries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ailment_id INT UNSIGNED DEFAULT NULL, actions JSON NOT NULL COMMENT \'(DC2Type:json)\', UNIQUE INDEX UNIQ_712E946B432CD43A (ailment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE ailment_recovery_items (ailment_recovery_id INT UNSIGNED NOT NULL, item_id INT UNSIGNED NOT NULL, INDEX IDX_400DCBFE8B04118A (ailment_recovery_id), INDEX IDX_400DCBFE126F525E (item_id), PRIMARY KEY(ailment_recovery_id, item_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE ailments (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('ALTER TABLE ailment_protections ADD CONSTRAINT FK_6630DD52432CD43A FOREIGN KEY (ailment_id) REFERENCES ailments (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE ailment_protection_skills ADD CONSTRAINT FK_517E18BFFE812F5B FOREIGN KEY (ailment_protection_id) REFERENCES ailment_protections (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE ailment_protection_skills ADD CONSTRAINT FK_517E18BF5585C142 FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE ailment_protection_item ADD CONSTRAINT FK_84E874CF1051F85E FOREIGN KEY (ailment_protection_items) REFERENCES ailment_protections (id)');
			$this->addSql('ALTER TABLE ailment_protection_item ADD CONSTRAINT FK_84E874CF126F525E FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE ailment_recoveries ADD CONSTRAINT FK_712E946B432CD43A FOREIGN KEY (ailment_id) REFERENCES ailments (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE ailment_recovery_items ADD CONSTRAINT FK_400DCBFE8B04118A FOREIGN KEY (ailment_recovery_id) REFERENCES ailment_recoveries (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE ailment_recovery_items ADD CONSTRAINT FK_400DCBFE126F525E FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			$this->addSql('ALTER TABLE ailment_protections DROP FOREIGN KEY FK_6630DD52432CD43A');
			$this->addSql('ALTER TABLE ailment_protection_skills DROP FOREIGN KEY FK_517E18BFFE812F5B');
			$this->addSql('ALTER TABLE ailment_protection_skills DROP FOREIGN KEY FK_517E18BF5585C142');
			$this->addSql('ALTER TABLE ailment_protection_item DROP FOREIGN KEY FK_84E874CF1051F85E');
			$this->addSql('ALTER TABLE ailment_protection_item DROP FOREIGN KEY FK_84E874CF126F525E');
			$this->addSql('ALTER TABLE ailment_recoveries DROP FOREIGN KEY FK_712E946B432CD43A');
			$this->addSql('ALTER TABLE ailment_recovery_items DROP FOREIGN KEY FK_400DCBFE8B04118A');
			$this->addSql('ALTER TABLE ailment_recovery_items DROP FOREIGN KEY FK_400DCBFE126F525E');
			$this->addSql('DROP TABLE ailment_protections');
			$this->addSql('DROP TABLE ailment_protection_skills');
			$this->addSql('DROP TABLE ailment_protection_item');
			$this->addSql('DROP TABLE ailment_recoveries');
			$this->addSql('DROP TABLE ailment_recovery_items');
			$this->addSql('DROP TABLE ailments');
		}
	}
