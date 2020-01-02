<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191231004121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE badge_user');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A76ED395');
        $this->addSql('DROP INDEX IDX_F65593E5A76ED395 ON annonce');
        $this->addSql('ALTER TABLE annonce DROP user_id, CHANGE annee annee DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE competences CHANGE competences_user_id competences_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219DA76ED395');
        $this->addSql('DROP INDEX IDX_8FDF219DA76ED395 ON reparation');
        $this->addSql('ALTER TABLE reparation DROP user_id');
        $this->addSql('ALTER TABLE badge CHANGE libelle libelle VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE pseudo pseudo VARCHAR(255) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE civilite civilite VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL, CHANGE ddn ddn DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE competences_user CHANGE descriptioncompetence descriptioncompetence VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE version_os_appareil CHANGE annonces_id annonces_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo_profil DROP FOREIGN KEY FK_B369C5BFA76ED395');
        $this->addSql('DROP INDEX IDX_B369C5BFA76ED395 ON photo_profil');
        $this->addSql('ALTER TABLE photo_profil DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE badge_user (badge_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_299D3A50F7A2C2FC (badge_id), INDEX IDX_299D3A50A76ED395 (user_id), PRIMARY KEY(badge_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE badge_user ADD CONSTRAINT FK_299D3A50A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge_user ADD CONSTRAINT FK_299D3A50F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce ADD user_id INT NOT NULL, CHANGE annee annee DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5A76ED395 ON annonce (user_id)');
        $this->addSql('ALTER TABLE badge CHANGE libelle libelle VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE competences CHANGE competences_user_id competences_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competences_user CHANGE descriptioncompetence descriptioncompetence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE photo_profil ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE photo_profil ADD CONSTRAINT FK_B369C5BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B369C5BFA76ED395 ON photo_profil (user_id)');
        $this->addSql('ALTER TABLE reparation ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FDF219DA76ED395 ON reparation (user_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE pseudo pseudo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE civilite civilite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ddn ddn DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE version_os_appareil CHANGE annonces_id annonces_id INT DEFAULT NULL');
    }
}
