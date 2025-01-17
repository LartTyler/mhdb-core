<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250117164513 extends AbstractMigration {
		public function getDescription(): string {
			return 'Add armor, armor set, and charm entities';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('CREATE TABLE armor_crafting (id INT UNSIGNED AUTO_INCREMENT NOT NULL, armor_id INT UNSIGNED DEFAULT NULL, zenny_cost INT UNSIGNED NOT NULL, UNIQUE INDEX UNIQ_4BFD47B3F5AA3663 (armor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE armor_crafting_costs (armor_crafting_id INT UNSIGNED NOT NULL, material_cost_id INT UNSIGNED NOT NULL, INDEX IDX_5B6BF2EDDD6DD251 (armor_crafting_id), INDEX IDX_5B6BF2EDAC255ED0 (material_cost_id), PRIMARY KEY(armor_crafting_id, material_cost_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE armor_set_bonus_ranks (id INT UNSIGNED AUTO_INCREMENT NOT NULL, bonus_id INT UNSIGNED DEFAULT NULL, skill_id INT UNSIGNED DEFAULT NULL, pieces INT UNSIGNED NOT NULL, INDEX IDX_5DF784FC69545666 (bonus_id), INDEX IDX_5DF784FC5585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE armor_set_bonuses (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE armor_sets (id INT UNSIGNED AUTO_INCREMENT NOT NULL, bonus_id INT UNSIGNED DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_7C8A0B1069545666 (bonus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE armors (id INT UNSIGNED AUTO_INCREMENT NOT NULL, armor_set_id INT UNSIGNED DEFAULT NULL, kind VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, rank VARCHAR(255) NOT NULL, rarity INT UNSIGNED NOT NULL, slots JSON NOT NULL COMMENT \'(DC2Type:json)\', resist_fire INT UNSIGNED NOT NULL, resist_water INT UNSIGNED NOT NULL, resist_ice INT UNSIGNED NOT NULL, resist_thunder INT UNSIGNED NOT NULL, resist_dragon INT UNSIGNED NOT NULL, defense_base INT UNSIGNED NOT NULL, defense_max INT UNSIGNED NOT NULL, defense_augmented INT UNSIGNED NOT NULL, INDEX IDX_AFBA56C2537E6F87 (armor_set_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE armor_skills (armor_id INT UNSIGNED NOT NULL, skill_rank_id INT UNSIGNED NOT NULL, INDEX IDX_96B474EFF5AA3663 (armor_id), INDEX IDX_96B474EF6CE3F9A6 (skill_rank_id), PRIMARY KEY(armor_id, skill_rank_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE charm_rank_crafting (id INT UNSIGNED AUTO_INCREMENT NOT NULL, charm_rank_id INT UNSIGNED DEFAULT NULL, craftable TINYINT(1) NOT NULL, zenny_cost INT NOT NULL, UNIQUE INDEX UNIQ_15C9995D3BA5C9D1 (charm_rank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE charm_rank_crafting_materials (charm_rank_crafting_id INT UNSIGNED NOT NULL, material_cost_id INT UNSIGNED NOT NULL, INDEX IDX_AC58A140401E3381 (charm_rank_crafting_id), INDEX IDX_AC58A140AC255ED0 (material_cost_id), PRIMARY KEY(charm_rank_crafting_id, material_cost_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE charm_ranks (id INT UNSIGNED AUTO_INCREMENT NOT NULL, charm_id INT UNSIGNED DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, level INT UNSIGNED NOT NULL, rarity INT UNSIGNED NOT NULL, INDEX IDX_DF91C65593E9261F (charm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE charm_rank_skills (charm_rank_id INT UNSIGNED NOT NULL, skill_rank_id INT UNSIGNED NOT NULL, INDEX IDX_6413356B3BA5C9D1 (charm_rank_id), INDEX IDX_6413356B6CE3F9A6 (skill_rank_id), PRIMARY KEY(charm_rank_id, skill_rank_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE charms (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('ALTER TABLE armor_crafting ADD CONSTRAINT FK_4BFD47B3F5AA3663 FOREIGN KEY (armor_id) REFERENCES armors (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE armor_crafting_costs ADD CONSTRAINT FK_5B6BF2EDDD6DD251 FOREIGN KEY (armor_crafting_id) REFERENCES armor_crafting (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE armor_crafting_costs ADD CONSTRAINT FK_5B6BF2EDAC255ED0 FOREIGN KEY (material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE armor_set_bonus_ranks ADD CONSTRAINT FK_5DF784FC69545666 FOREIGN KEY (bonus_id) REFERENCES armor_set_bonuses (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE armor_set_bonus_ranks ADD CONSTRAINT FK_5DF784FC5585C142 FOREIGN KEY (skill_id) REFERENCES skill_ranks (id)');
			$this->addSql('ALTER TABLE armor_sets ADD CONSTRAINT FK_7C8A0B1069545666 FOREIGN KEY (bonus_id) REFERENCES armor_set_bonuses (id) ON DELETE SET NULL');
			$this->addSql('ALTER TABLE armors ADD CONSTRAINT FK_AFBA56C2537E6F87 FOREIGN KEY (armor_set_id) REFERENCES armor_sets (id) ON DELETE SET NULL');
			$this->addSql('ALTER TABLE armor_skills ADD CONSTRAINT FK_96B474EFF5AA3663 FOREIGN KEY (armor_id) REFERENCES armors (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE armor_skills ADD CONSTRAINT FK_96B474EF6CE3F9A6 FOREIGN KEY (skill_rank_id) REFERENCES skill_ranks (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE charm_rank_crafting ADD CONSTRAINT FK_15C9995D3BA5C9D1 FOREIGN KEY (charm_rank_id) REFERENCES charm_ranks (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE charm_rank_crafting_materials ADD CONSTRAINT FK_AC58A140401E3381 FOREIGN KEY (charm_rank_crafting_id) REFERENCES charm_rank_crafting (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE charm_rank_crafting_materials ADD CONSTRAINT FK_AC58A140AC255ED0 FOREIGN KEY (material_cost_id) REFERENCES crafting_material_costs (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE charm_ranks ADD CONSTRAINT FK_DF91C65593E9261F FOREIGN KEY (charm_id) REFERENCES charms (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE charm_rank_skills ADD CONSTRAINT FK_6413356B3BA5C9D1 FOREIGN KEY (charm_rank_id) REFERENCES charm_ranks (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE charm_rank_skills ADD CONSTRAINT FK_6413356B6CE3F9A6 FOREIGN KEY (skill_rank_id) REFERENCES skill_ranks (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE camps DROP FOREIGN KEY FK_3D166BE564D218E');
			$this->addSql('ALTER TABLE camps CHANGE location_id location_id INT UNSIGNED DEFAULT NULL');
			$this->addSql('ALTER TABLE camps ADD CONSTRAINT FK_3D166BE564D218E FOREIGN KEY (location_id) REFERENCES locations (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE skill_ranks DROP FOREIGN KEY FK_EECE33285585C142');
			$this->addSql('ALTER TABLE skill_ranks CHANGE skill_id skill_id INT UNSIGNED DEFAULT NULL');
			$this->addSql('ALTER TABLE skill_ranks ADD CONSTRAINT FK_EECE33285585C142 FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_crafting DROP FOREIGN KEY FK_6F8C205E2DE62210');
			$this->addSql('ALTER TABLE weapon_crafting ADD weapon_id INT UNSIGNED DEFAULT NULL');
			$this->addSql('ALTER TABLE weapon_crafting ADD CONSTRAINT FK_6F8C205E95B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_crafting ADD CONSTRAINT FK_6F8C205E2DE62210 FOREIGN KEY (previous_id) REFERENCES weapons (id) ON DELETE SET NULL');
			$this->addSql('CREATE UNIQUE INDEX UNIQ_6F8C205E95B82273 ON weapon_crafting (weapon_id)');
			$this->addSql('ALTER TABLE weapon_specials DROP FOREIGN KEY FK_5355A53F95B82273');
			$this->addSql('ALTER TABLE weapon_specials CHANGE weapon_id weapon_id INT UNSIGNED DEFAULT NULL');
			$this->addSql('ALTER TABLE weapon_specials ADD CONSTRAINT FK_5355A53F95B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapons DROP FOREIGN KEY FK_520EBBE123BE98B5');
			$this->addSql('DROP INDEX IDX_520EBBE123BE98B5 ON weapons');
			$this->addSql('ALTER TABLE weapons DROP crafting_id');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE armor_crafting DROP FOREIGN KEY FK_4BFD47B3F5AA3663');
			$this->addSql('ALTER TABLE armor_crafting_costs DROP FOREIGN KEY FK_5B6BF2EDDD6DD251');
			$this->addSql('ALTER TABLE armor_crafting_costs DROP FOREIGN KEY FK_5B6BF2EDAC255ED0');
			$this->addSql('ALTER TABLE armor_set_bonus_ranks DROP FOREIGN KEY FK_5DF784FC69545666');
			$this->addSql('ALTER TABLE armor_set_bonus_ranks DROP FOREIGN KEY FK_5DF784FC5585C142');
			$this->addSql('ALTER TABLE armor_sets DROP FOREIGN KEY FK_7C8A0B1069545666');
			$this->addSql('ALTER TABLE armors DROP FOREIGN KEY FK_AFBA56C2537E6F87');
			$this->addSql('ALTER TABLE armor_skills DROP FOREIGN KEY FK_96B474EFF5AA3663');
			$this->addSql('ALTER TABLE armor_skills DROP FOREIGN KEY FK_96B474EF6CE3F9A6');
			$this->addSql('ALTER TABLE charm_rank_crafting DROP FOREIGN KEY FK_15C9995D3BA5C9D1');
			$this->addSql('ALTER TABLE charm_rank_crafting_materials DROP FOREIGN KEY FK_AC58A140401E3381');
			$this->addSql('ALTER TABLE charm_rank_crafting_materials DROP FOREIGN KEY FK_AC58A140AC255ED0');
			$this->addSql('ALTER TABLE charm_ranks DROP FOREIGN KEY FK_DF91C65593E9261F');
			$this->addSql('ALTER TABLE charm_rank_skills DROP FOREIGN KEY FK_6413356B3BA5C9D1');
			$this->addSql('ALTER TABLE charm_rank_skills DROP FOREIGN KEY FK_6413356B6CE3F9A6');
			$this->addSql('DROP TABLE armor_crafting');
			$this->addSql('DROP TABLE armor_crafting_costs');
			$this->addSql('DROP TABLE armor_set_bonus_ranks');
			$this->addSql('DROP TABLE armor_set_bonuses');
			$this->addSql('DROP TABLE armor_sets');
			$this->addSql('DROP TABLE armors');
			$this->addSql('DROP TABLE armor_skills');
			$this->addSql('DROP TABLE charm_rank_crafting');
			$this->addSql('DROP TABLE charm_rank_crafting_materials');
			$this->addSql('DROP TABLE charm_ranks');
			$this->addSql('DROP TABLE charm_rank_skills');
			$this->addSql('DROP TABLE charms');
			$this->addSql('ALTER TABLE weapons ADD crafting_id INT UNSIGNED DEFAULT NULL');
			$this->addSql('ALTER TABLE weapons ADD CONSTRAINT FK_520EBBE123BE98B5 FOREIGN KEY (crafting_id) REFERENCES weapon_crafting (id) ON DELETE CASCADE');
			$this->addSql('CREATE INDEX IDX_520EBBE123BE98B5 ON weapons (crafting_id)');
			$this->addSql('ALTER TABLE weapon_crafting DROP FOREIGN KEY FK_6F8C205E95B82273');
			$this->addSql('ALTER TABLE weapon_crafting DROP FOREIGN KEY FK_6F8C205E2DE62210');
			$this->addSql('DROP INDEX UNIQ_6F8C205E95B82273 ON weapon_crafting');
			$this->addSql('ALTER TABLE weapon_crafting DROP weapon_id');
			$this->addSql('ALTER TABLE weapon_crafting ADD CONSTRAINT FK_6F8C205E2DE62210 FOREIGN KEY (previous_id) REFERENCES weapons (id)');
			$this->addSql('ALTER TABLE weapon_specials DROP FOREIGN KEY FK_5355A53F95B82273');
			$this->addSql('ALTER TABLE weapon_specials CHANGE weapon_id weapon_id INT UNSIGNED NOT NULL');
			$this->addSql('ALTER TABLE weapon_specials ADD CONSTRAINT FK_5355A53F95B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id)');
			$this->addSql('ALTER TABLE camps DROP FOREIGN KEY FK_3D166BE564D218E');
			$this->addSql('ALTER TABLE camps CHANGE location_id location_id INT UNSIGNED NOT NULL');
			$this->addSql('ALTER TABLE camps ADD CONSTRAINT FK_3D166BE564D218E FOREIGN KEY (location_id) REFERENCES locations (id)');
			$this->addSql('ALTER TABLE skill_ranks DROP FOREIGN KEY FK_EECE33285585C142');
			$this->addSql('ALTER TABLE skill_ranks CHANGE skill_id skill_id INT UNSIGNED NOT NULL');
			$this->addSql('ALTER TABLE skill_ranks ADD CONSTRAINT FK_EECE33285585C142 FOREIGN KEY (skill_id) REFERENCES skills (id)');
			// @formatter:on
		}
	}
