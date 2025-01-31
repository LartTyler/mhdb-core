<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250117215222 extends AbstractMigration {
		public function getDescription(): string {
			return 'Add monster and motion value entities';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('CREATE TABLE monster_resistances (id INT UNSIGNED AUTO_INCREMENT NOT NULL, monster_id INT UNSIGNED DEFAULT NULL, _condition LONGTEXT DEFAULT NULL, kind VARCHAR(255) NOT NULL, element VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_7DE8A429C5FF1223 (monster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE monster_reward_conditions (id INT UNSIGNED AUTO_INCREMENT NOT NULL, reward_id INT UNSIGNED DEFAULT NULL, kind VARCHAR(255) NOT NULL, rank VARCHAR(255) NOT NULL, quantity INT UNSIGNED NOT NULL, chance INT UNSIGNED NOT NULL, subtype VARCHAR(255) DEFAULT NULL, INDEX IDX_B134FDFDE466ACA1 (reward_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE monster_rewards (id INT UNSIGNED AUTO_INCREMENT NOT NULL, monster_id INT UNSIGNED DEFAULT NULL, item_id INT UNSIGNED DEFAULT NULL, INDEX IDX_4B43AF08C5FF1223 (monster_id), INDEX IDX_4B43AF08126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE monster_weaknesses (id INT UNSIGNED AUTO_INCREMENT NOT NULL, monster_id INT UNSIGNED DEFAULT NULL, level INT UNSIGNED NOT NULL, `condition` LONGTEXT DEFAULT NULL, kind VARCHAR(255) NOT NULL, element VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_1D01676C5FF1223 (monster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE monsters (id INT UNSIGNED AUTO_INCREMENT NOT NULL, kind VARCHAR(255) NOT NULL, species VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, elements JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE monster_ailments (monster_id INT UNSIGNED NOT NULL, ailment_id INT UNSIGNED NOT NULL, INDEX IDX_3F33B44C5FF1223 (monster_id), INDEX IDX_3F33B44432CD43A (ailment_id), PRIMARY KEY(monster_id, ailment_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE monster_locations (monster_id INT UNSIGNED NOT NULL, location_id INT UNSIGNED NOT NULL, INDEX IDX_F35E41FDC5FF1223 (monster_id), INDEX IDX_F35E41FD64D218E (location_id), PRIMARY KEY(monster_id, location_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE motion_values (id INT UNSIGNED AUTO_INCREMENT NOT NULL, weapon VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, damage VARCHAR(255) NOT NULL, stun INT UNSIGNED NOT NULL, exhaust INT UNSIGNED NOT NULL, hits JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('ALTER TABLE monster_resistances ADD CONSTRAINT FK_7DE8A429C5FF1223 FOREIGN KEY (monster_id) REFERENCES monsters (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_reward_conditions ADD CONSTRAINT FK_B134FDFDE466ACA1 FOREIGN KEY (reward_id) REFERENCES monster_rewards (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_rewards ADD CONSTRAINT FK_4B43AF08C5FF1223 FOREIGN KEY (monster_id) REFERENCES monsters (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_rewards ADD CONSTRAINT FK_4B43AF08126F525E FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_weaknesses ADD CONSTRAINT FK_1D01676C5FF1223 FOREIGN KEY (monster_id) REFERENCES monsters (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_ailments ADD CONSTRAINT FK_3F33B44C5FF1223 FOREIGN KEY (monster_id) REFERENCES monsters (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_ailments ADD CONSTRAINT FK_3F33B44432CD43A FOREIGN KEY (ailment_id) REFERENCES ailments (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_locations ADD CONSTRAINT FK_F35E41FDC5FF1223 FOREIGN KEY (monster_id) REFERENCES monsters (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE monster_locations ADD CONSTRAINT FK_F35E41FD64D218E FOREIGN KEY (location_id) REFERENCES locations (id) ON DELETE CASCADE');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			$this->addSql('ALTER TABLE monster_resistances DROP FOREIGN KEY FK_7DE8A429C5FF1223');
			$this->addSql('ALTER TABLE monster_reward_conditions DROP FOREIGN KEY FK_B134FDFDE466ACA1');
			$this->addSql('ALTER TABLE monster_rewards DROP FOREIGN KEY FK_4B43AF08C5FF1223');
			$this->addSql('ALTER TABLE monster_rewards DROP FOREIGN KEY FK_4B43AF08126F525E');
			$this->addSql('ALTER TABLE monster_weaknesses DROP FOREIGN KEY FK_1D01676C5FF1223');
			$this->addSql('ALTER TABLE monster_ailments DROP FOREIGN KEY FK_3F33B44C5FF1223');
			$this->addSql('ALTER TABLE monster_ailments DROP FOREIGN KEY FK_3F33B44432CD43A');
			$this->addSql('ALTER TABLE monster_locations DROP FOREIGN KEY FK_F35E41FDC5FF1223');
			$this->addSql('ALTER TABLE monster_locations DROP FOREIGN KEY FK_F35E41FD64D218E');
			$this->addSql('DROP TABLE monster_resistances');
			$this->addSql('DROP TABLE monster_reward_conditions');
			$this->addSql('DROP TABLE monster_rewards');
			$this->addSql('DROP TABLE monster_weaknesses');
			$this->addSql('DROP TABLE monsters');
			$this->addSql('DROP TABLE monster_ailments');
			$this->addSql('DROP TABLE monster_locations');
			$this->addSql('DROP TABLE motion_values');
		}
	}
