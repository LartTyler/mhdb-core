<?php
	declare(strict_types=1);

	namespace DoctrineMigrations;

	use Doctrine\DBAL\Schema\Schema;
	use Doctrine\Migrations\AbstractMigration;

	final class Version20250117165433 extends AbstractMigration {
		public function getDescription(): string {
			return 'Add decoration entity';
		}

		public function up(Schema $schema): void {
			// @formatter:off
			$this->addSql('CREATE TABLE decorations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, slot INT UNSIGNED NOT NULL, rarity INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('CREATE TABLE decoration_skills (decoration_id INT UNSIGNED NOT NULL, skill_rank_id INT UNSIGNED NOT NULL, INDEX IDX_FE93F0BA3446DFC4 (decoration_id), INDEX IDX_FE93F0BA6CE3F9A6 (skill_rank_id), PRIMARY KEY(decoration_id, skill_rank_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
			$this->addSql('ALTER TABLE decoration_skills ADD CONSTRAINT FK_FE93F0BA3446DFC4 FOREIGN KEY (decoration_id) REFERENCES decorations (id) ON DELETE CASCADE');
			$this->addSql('ALTER TABLE decoration_skills ADD CONSTRAINT FK_FE93F0BA6CE3F9A6 FOREIGN KEY (skill_rank_id) REFERENCES skill_ranks (id) ON DELETE CASCADE');
			// @formatter:on
		}

		public function down(Schema $schema): void {
			$this->addSql('ALTER TABLE decoration_skills DROP FOREIGN KEY FK_FE93F0BA3446DFC4');
			$this->addSql('ALTER TABLE decoration_skills DROP FOREIGN KEY FK_FE93F0BA6CE3F9A6');
			$this->addSql('DROP TABLE decorations');
			$this->addSql('DROP TABLE decoration_skills');
		}
	}
