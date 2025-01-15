<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250115220718 extends AbstractMigration {
		public function getDescription(): string {
			return 'Add weapon crafting';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('CREATE TABLE crafting_material_costs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, quantity INT UNSIGNED NOT NULL, INDEX IDX_1B8FBFE6126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE items (id INT UNSIGNED AUTO_INCREMENT NOT NULL, rarity INT UNSIGNED NOT NULL, name VARCHAR(64) NOT NULL, description LONGTEXT NOT NULL, _value INT UNSIGNED NOT NULL, carry_limit INT UNSIGNED NOT NULL, UNIQUE INDEX UNIQ_E11EE94D5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapon_crafting (id INT UNSIGNED AUTO_INCREMENT NOT NULL, previous_id INT UNSIGNED DEFAULT NULL, craftable TINYINT(1) NOT NULL, crafting_zenny_cost INT UNSIGNED NOT NULL, upgrade_zenny_cost INT UNSIGNED NOT NULL, INDEX IDX_6F8C205E2DE62210 (previous_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapon_crafting_branches (weapon_crafting_id INT UNSIGNED NOT NULL, weapon_id INT UNSIGNED NOT NULL, INDEX IDX_C5251B471E92D4C (weapon_crafting_id), INDEX IDX_C5251B495B82273 (weapon_id), PRIMARY KEY(weapon_crafting_id, weapon_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapon_crafting_costs (weapon_crafting_id INT UNSIGNED NOT NULL, crafting_material_cost_id INT UNSIGNED NOT NULL, INDEX IDX_3664782971E92D4C (weapon_crafting_id), INDEX IDX_36647829DD94392C (crafting_material_cost_id), PRIMARY KEY(weapon_crafting_id, crafting_material_cost_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapon_crafting_upgrade_costs (weapon_crafting_id INT UNSIGNED NOT NULL, crafting_material_cost_id INT UNSIGNED NOT NULL, INDEX IDX_33949D571E92D4C (weapon_crafting_id), INDEX IDX_33949D5DD94392C (crafting_material_cost_id), PRIMARY KEY(weapon_crafting_id, crafting_material_cost_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('ALTER TABLE crafting_material_costs ADD CONSTRAINT FK_1B8FBFE6126F525E FOREIGN KEY (item_id) REFERENCES items (id)');
			$this->addSql('ALTER TABLE weapon_crafting ADD CONSTRAINT FK_6F8C205E2DE62210 FOREIGN KEY (previous_id) REFERENCES weapons (id)');
			$this->addSql('ALTER TABLE weapon_crafting_branches ADD CONSTRAINT FK_C5251B471E92D4C FOREIGN KEY (weapon_crafting_id) REFERENCES weapon_crafting (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_crafting_branches ADD CONSTRAINT FK_C5251B495B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_crafting_costs ADD CONSTRAINT FK_3664782971E92D4C FOREIGN KEY (weapon_crafting_id) REFERENCES weapon_crafting (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_crafting_costs ADD CONSTRAINT FK_36647829DD94392C FOREIGN KEY (crafting_material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs ADD CONSTRAINT FK_33949D571E92D4C FOREIGN KEY (weapon_crafting_id) REFERENCES weapon_crafting (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs ADD CONSTRAINT FK_33949D5DD94392C FOREIGN KEY (crafting_material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapons ADD crafting_id INT UNSIGNED DEFAULT NULL');
			$this->addSql('ALTER TABLE weapons ADD CONSTRAINT FK_520EBBE123BE98B5 FOREIGN KEY (crafting_id) REFERENCES weapon_crafting (id) ON DELETE CASCADE');
			$this->addSql('CREATE INDEX IDX_520EBBE123BE98B5 ON weapons (crafting_id)');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			$this->addSql('ALTER TABLE weapons DROP FOREIGN KEY FK_520EBBE123BE98B5');
			$this->addSql('ALTER TABLE crafting_material_costs DROP FOREIGN KEY FK_1B8FBFE6126F525E');
			$this->addSql('ALTER TABLE weapon_crafting DROP FOREIGN KEY FK_6F8C205E2DE62210');
			$this->addSql('ALTER TABLE weapon_crafting_branches DROP FOREIGN KEY FK_C5251B471E92D4C');
			$this->addSql('ALTER TABLE weapon_crafting_branches DROP FOREIGN KEY FK_C5251B495B82273');
			$this->addSql('ALTER TABLE weapon_crafting_costs DROP FOREIGN KEY FK_3664782971E92D4C');
			$this->addSql('ALTER TABLE weapon_crafting_costs DROP FOREIGN KEY FK_36647829DD94392C');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs DROP FOREIGN KEY FK_33949D571E92D4C');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs DROP FOREIGN KEY FK_33949D5DD94392C');
			$this->addSql('DROP TABLE crafting_material_costs');
			$this->addSql('DROP TABLE items');
			$this->addSql('DROP TABLE weapon_crafting');
			$this->addSql('DROP TABLE weapon_crafting_branches');
			$this->addSql('DROP TABLE weapon_crafting_costs');
			$this->addSql('DROP TABLE weapon_crafting_upgrade_costs');
			$this->addSql('DROP INDEX IDX_520EBBE123BE98B5 ON weapons');
			$this->addSql('ALTER TABLE weapons DROP crafting_id');
		}
	}
