<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	/**
	 * Auto-generated Migration: Please modify to your needs!
	 */
	final class Version20240510191451 extends AbstractMigration {
		public function getDescription(): string {
			return 'Add weapon-related tables';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('CREATE TABLE auto_reload (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ammo VARCHAR(255) NOT NULL, level INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE horn_melodies (id INT UNSIGNED AUTO_INCREMENT NOT NULL, notes JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE horn_songs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, melody_id INT UNSIGNED NOT NULL, sequence JSON NOT NULL COMMENT \'(DC2Type:json)\', duration INT UNSIGNED NOT NULL, effects VARCHAR(255) DEFAULT NULL, personal TINYINT(1) NOT NULL, INDEX IDX_168A3F76851F6525 (melody_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE rapid_fire (id INT UNSIGNED AUTO_INCREMENT NOT NULL, kind VARCHAR(255) NOT NULL, level INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE sharpness (id INT UNSIGNED AUTO_INCREMENT NOT NULL, weapon_id INT UNSIGNED NOT NULL, red INT UNSIGNED NOT NULL, orange INT UNSIGNED NOT NULL, yellow INT UNSIGNED NOT NULL, green INT UNSIGNED NOT NULL, blue INT UNSIGNED NOT NULL, white INT UNSIGNED NOT NULL, purple INT UNSIGNED NOT NULL, INDEX IDX_E62BD8AC95B82273 (weapon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE skill_ranks (id INT UNSIGNED AUTO_INCREMENT NOT NULL, skill_id INT UNSIGNED NOT NULL, level INT UNSIGNED NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_EECE33285585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE skills (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapon_ammo (id INT UNSIGNED AUTO_INCREMENT NOT NULL, kind VARCHAR(255) NOT NULL, capacities JSON NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapon_specials (id INT UNSIGNED AUTO_INCREMENT NOT NULL, weapon_id INT UNSIGNED NOT NULL, hidden TINYINT(1) NOT NULL, damage_raw INT UNSIGNED NOT NULL, damage_display INT UNSIGNED NOT NULL, kind VARCHAR(255) NOT NULL, element VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_5355A53F95B82273 (weapon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapons (id INT UNSIGNED AUTO_INCREMENT NOT NULL, melody_id INT UNSIGNED NOT NULL, name VARCHAR(255) DEFAULT NULL, rarity INT NOT NULL, damage_kind VARCHAR(255) NOT NULL, defense_bonus INT UNSIGNED NOT NULL, elderseal VARCHAR(255) DEFAULT NULL, affinity INT UNSIGNED NOT NULL, slots JSON NOT NULL COMMENT \'(DC2Type:json)\', attack_raw INT UNSIGNED NOT NULL, attack_display INT UNSIGNED NOT NULL, kind VARCHAR(255) NOT NULL, shell VARCHAR(255) DEFAULT NULL, shell_level INT UNSIGNED DEFAULT NULL, coatings JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', deviation VARCHAR(255) DEFAULT NULL, special_ammo VARCHAR(255) DEFAULT NULL, INDEX IDX_520EBBE1851F6525 (melody_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE weapon_skills (weapon_id INT UNSIGNED NOT NULL, skill_id INT UNSIGNED NOT NULL, INDEX IDX_E8C4395795B82273 (weapon_id), INDEX IDX_E8C439575585C142 (skill_id), PRIMARY KEY(weapon_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE heavy_bowgun_ammo (heavy_bowgun_id INT UNSIGNED NOT NULL, ammo_id INT UNSIGNED NOT NULL, INDEX IDX_1B7A7365B3D3C464 (heavy_bowgun_id), INDEX IDX_1B7A73659F20CC20 (ammo_id), PRIMARY KEY(heavy_bowgun_id, ammo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE heavy_bowgun_auto_reload (heavy_bowgun_id INT UNSIGNED NOT NULL, auto_reload_id INT UNSIGNED NOT NULL, INDEX IDX_FD3283DB3D3C464 (heavy_bowgun_id), INDEX IDX_FD3283DB13121A6 (auto_reload_id), PRIMARY KEY(heavy_bowgun_id, auto_reload_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE light_bowgun_ammo (light_bowgun_id INT UNSIGNED NOT NULL, ammo_id INT UNSIGNED NOT NULL, INDEX IDX_7AF5A029D029C12 (light_bowgun_id), INDEX IDX_7AF5A029F20CC20 (ammo_id), PRIMARY KEY(light_bowgun_id, ammo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE light_bowgun_auto_reload (light_bowgun_id INT UNSIGNED NOT NULL, auto_reload_id INT UNSIGNED NOT NULL, INDEX IDX_3ABB16A69D029C12 (light_bowgun_id), INDEX IDX_3ABB16A6B13121A6 (auto_reload_id), PRIMARY KEY(light_bowgun_id, auto_reload_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE light_bowgun_rapid_fire (light_bowgun_id INT UNSIGNED NOT NULL, rapid_fire_id INT UNSIGNED NOT NULL, INDEX IDX_6091D3AE9D029C12 (light_bowgun_id), INDEX IDX_6091D3AEE9056C50 (rapid_fire_id), PRIMARY KEY(light_bowgun_id, rapid_fire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
			$this->addSql('ALTER TABLE horn_songs ADD CONSTRAINT FK_168A3F76851F6525 FOREIGN KEY (melody_id) REFERENCES horn_melodies (id)');
			$this->addSql('ALTER TABLE sharpness ADD CONSTRAINT FK_E62BD8AC95B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id)');
			$this->addSql('ALTER TABLE skill_ranks ADD CONSTRAINT FK_EECE33285585C142 FOREIGN KEY (skill_id) REFERENCES skills (id)');
			$this->addSql('ALTER TABLE weapon_specials ADD CONSTRAINT FK_5355A53F95B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id)');
			$this->addSql('ALTER TABLE weapons ADD CONSTRAINT FK_520EBBE1851F6525 FOREIGN KEY (melody_id) REFERENCES horn_melodies (id)');
			$this->addSql('ALTER TABLE weapon_skills ADD CONSTRAINT FK_E8C4395795B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE weapon_skills ADD CONSTRAINT FK_E8C439575585C142 FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE heavy_bowgun_ammo ADD CONSTRAINT FK_1B7A7365B3D3C464 FOREIGN KEY (heavy_bowgun_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE heavy_bowgun_ammo ADD CONSTRAINT FK_1B7A73659F20CC20 FOREIGN KEY (ammo_id) REFERENCES weapon_ammo (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE heavy_bowgun_auto_reload ADD CONSTRAINT FK_FD3283DB3D3C464 FOREIGN KEY (heavy_bowgun_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE heavy_bowgun_auto_reload ADD CONSTRAINT FK_FD3283DB13121A6 FOREIGN KEY (auto_reload_id) REFERENCES auto_reload (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE light_bowgun_ammo ADD CONSTRAINT FK_7AF5A029D029C12 FOREIGN KEY (light_bowgun_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE light_bowgun_ammo ADD CONSTRAINT FK_7AF5A029F20CC20 FOREIGN KEY (ammo_id) REFERENCES weapon_ammo (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE light_bowgun_auto_reload ADD CONSTRAINT FK_3ABB16A69D029C12 FOREIGN KEY (light_bowgun_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE light_bowgun_auto_reload ADD CONSTRAINT FK_3ABB16A6B13121A6 FOREIGN KEY (auto_reload_id) REFERENCES auto_reload (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE light_bowgun_rapid_fire ADD CONSTRAINT FK_6091D3AE9D029C12 FOREIGN KEY (light_bowgun_id) REFERENCES weapons (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE light_bowgun_rapid_fire ADD CONSTRAINT FK_6091D3AEE9056C50 FOREIGN KEY (rapid_fire_id) REFERENCES rapid_fire (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE locations CHANGE name name VARCHAR(255) DEFAULT NULL');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			// @formatter:off
			$this->addSql('ALTER TABLE horn_songs DROP FOREIGN KEY FK_168A3F76851F6525');
			$this->addSql('ALTER TABLE sharpness DROP FOREIGN KEY FK_E62BD8AC95B82273');
			$this->addSql('ALTER TABLE skill_ranks DROP FOREIGN KEY FK_EECE33285585C142');
			$this->addSql('ALTER TABLE weapon_specials DROP FOREIGN KEY FK_5355A53F95B82273');
			$this->addSql('ALTER TABLE weapons DROP FOREIGN KEY FK_520EBBE1851F6525');
			$this->addSql('ALTER TABLE weapon_skills DROP FOREIGN KEY FK_E8C4395795B82273');
			$this->addSql('ALTER TABLE weapon_skills DROP FOREIGN KEY FK_E8C439575585C142');
			$this->addSql('ALTER TABLE heavy_bowgun_ammo DROP FOREIGN KEY FK_1B7A7365B3D3C464');
			$this->addSql('ALTER TABLE heavy_bowgun_ammo DROP FOREIGN KEY FK_1B7A73659F20CC20');
			$this->addSql('ALTER TABLE heavy_bowgun_auto_reload DROP FOREIGN KEY FK_FD3283DB3D3C464');
			$this->addSql('ALTER TABLE heavy_bowgun_auto_reload DROP FOREIGN KEY FK_FD3283DB13121A6');
			$this->addSql('ALTER TABLE light_bowgun_ammo DROP FOREIGN KEY FK_7AF5A029D029C12');
			$this->addSql('ALTER TABLE light_bowgun_ammo DROP FOREIGN KEY FK_7AF5A029F20CC20');
			$this->addSql('ALTER TABLE light_bowgun_auto_reload DROP FOREIGN KEY FK_3ABB16A69D029C12');
			$this->addSql('ALTER TABLE light_bowgun_auto_reload DROP FOREIGN KEY FK_3ABB16A6B13121A6');
			$this->addSql('ALTER TABLE light_bowgun_rapid_fire DROP FOREIGN KEY FK_6091D3AE9D029C12');
			$this->addSql('ALTER TABLE light_bowgun_rapid_fire DROP FOREIGN KEY FK_6091D3AEE9056C50');
			$this->addSql('DROP TABLE auto_reload');
			$this->addSql('DROP TABLE horn_melodies');
			$this->addSql('DROP TABLE horn_songs');
			$this->addSql('DROP TABLE rapid_fire');
			$this->addSql('DROP TABLE sharpness');
			$this->addSql('DROP TABLE skill_ranks');
			$this->addSql('DROP TABLE skills');
			$this->addSql('DROP TABLE weapon_ammo');
			$this->addSql('DROP TABLE weapon_specials');
			$this->addSql('DROP TABLE weapons');
			$this->addSql('DROP TABLE weapon_skills');
			$this->addSql('DROP TABLE heavy_bowgun_ammo');
			$this->addSql('DROP TABLE heavy_bowgun_auto_reload');
			$this->addSql('DROP TABLE light_bowgun_ammo');
			$this->addSql('DROP TABLE light_bowgun_auto_reload');
			$this->addSql('DROP TABLE light_bowgun_rapid_fire');
			$this->addSql('ALTER TABLE locations CHANGE name name VARCHAR(255) NOT NULL');
			// @formatter:on
		}
	}
