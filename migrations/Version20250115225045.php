<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250115225045 extends AbstractMigration {
		public function getDescription(): string {
			return 'WIP';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE weapon_crafting_costs DROP FOREIGN KEY FK_36647829DD94392C');
			$this->addSql('DROP INDEX IDX_36647829DD94392C ON weapon_crafting_costs');
			$this->addSql('DROP INDEX `primary` ON weapon_crafting_costs');
			$this->addSql('ALTER TABLE weapon_crafting_costs CHANGE crafting_material_cost_id material_cost_id INT UNSIGNED NOT NULL');
			$this->addSql('ALTER TABLE weapon_crafting_costs ADD CONSTRAINT FK_36647829AC255ED0 FOREIGN KEY (material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('CREATE INDEX IDX_36647829AC255ED0 ON weapon_crafting_costs (material_cost_id)');
			$this->addSql('ALTER TABLE weapon_crafting_costs ADD PRIMARY KEY (weapon_crafting_id, material_cost_id)');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs DROP FOREIGN KEY FK_33949D5DD94392C');
			$this->addSql('DROP INDEX IDX_33949D5DD94392C ON weapon_crafting_upgrade_costs');
			$this->addSql('DROP INDEX `primary` ON weapon_crafting_upgrade_costs');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs CHANGE crafting_material_cost_id material_cost_id INT UNSIGNED NOT NULL');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs ADD CONSTRAINT FK_33949D5AC255ED0 FOREIGN KEY (material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('CREATE INDEX IDX_33949D5AC255ED0 ON weapon_crafting_upgrade_costs (material_cost_id)');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs ADD PRIMARY KEY (weapon_crafting_id, material_cost_id)');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE weapon_crafting_costs DROP FOREIGN KEY FK_36647829AC255ED0');
			$this->addSql('DROP INDEX IDX_36647829AC255ED0 ON weapon_crafting_costs');
			$this->addSql('DROP INDEX `PRIMARY` ON weapon_crafting_costs');
			$this->addSql('ALTER TABLE weapon_crafting_costs CHANGE material_cost_id crafting_material_cost_id INT UNSIGNED NOT NULL');
			$this->addSql('ALTER TABLE weapon_crafting_costs ADD CONSTRAINT FK_36647829DD94392C FOREIGN KEY (crafting_material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('CREATE INDEX IDX_36647829DD94392C ON weapon_crafting_costs (crafting_material_cost_id)');
			$this->addSql('ALTER TABLE weapon_crafting_costs ADD PRIMARY KEY (weapon_crafting_id, crafting_material_cost_id)');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs DROP FOREIGN KEY FK_33949D5AC255ED0');
			$this->addSql('DROP INDEX IDX_33949D5AC255ED0 ON weapon_crafting_upgrade_costs');
			$this->addSql('DROP INDEX `PRIMARY` ON weapon_crafting_upgrade_costs');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs CHANGE material_cost_id crafting_material_cost_id INT UNSIGNED NOT NULL');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs ADD CONSTRAINT FK_33949D5DD94392C FOREIGN KEY (crafting_material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('CREATE INDEX IDX_33949D5DD94392C ON weapon_crafting_upgrade_costs (crafting_material_cost_id)');
			$this->addSql('ALTER TABLE weapon_crafting_upgrade_costs ADD PRIMARY KEY (weapon_crafting_id, crafting_material_cost_id)');
			// @formatter:on
		}
	}
