<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181031132820 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, theme_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, avatar_path VARCHAR(255) DEFAULT NULL, situation_professionnelle ENUM(\'EN_POSTE\', \'EN_FIN_DE_CONTRAT\', \'EN_RECHERCHE_EMPLOI\', \'FREELANCE\', \'CONSULTANT\', \'ENTREPRENEUR\', \'PORTEUR_DE_PROJET\', \'ETUDIANT\', \'EN_FIN_ETUDE\', \'STAGIAIRE\', \'APPRENTI\', \'EN_ALTERNANCE\') DEFAULT NULL COMMENT \'(DC2Type:SituationProfessionnelleEnumType)\', disponibilite ENUM(\'RECHERCHE_ACTIVE\', \'RECHERCHE_STAGE\', \'SIMPLE_VEILLE\', \'OPPORTUNITE\', \'INDISPONIBLE\') DEFAULT NULL COMMENT \'(DC2Type:DisponibiliteEnumType)\', INDEX IDX_B66FFE92A76ED395 (user_id), INDEX IDX_B66FFE9259027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, domaine_id INT NOT NULL, nom VARCHAR(100) NOT NULL, note INT DEFAULT NULL, INDEX IDX_94D4687F4272FC9F (domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_domaine (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, nom VARCHAR(50) NOT NULL, INDEX IDX_6CE7B5E6CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, c_v_id INT DEFAULT NULL, type ENUM(\'EMAIL\', \'TEL_MOBILE\', \'TEL_FIXE\', \'SKYPE\') NOT NULL COMMENT \'(DC2Type:ContactEnumType)\', valeur VARCHAR(100) NOT NULL, INDEX IDX_4C62E638A76ED395 (user_id), INDEX IDX_4C62E63852B5672F (c_v_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, logo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, informations_generales_id INT NOT NULL, entreprise_id INT DEFAULT NULL, cv_id INT NOT NULL, ville_id INT DEFAULT NULL, type_contrat ENUM(\'CDI\', \'CDD\', \'STA\', \'INT\', \'CA\', \'CP\', \'EJ\', \'PE\', \'BEN\', \'FREE\', \'VAC\', \'AUT\') NOT NULL COMMENT \'(DC2Type:TypeContratEnumType)\', UNIQUE INDEX UNIQ_590C10395220281 (informations_generales_id), INDEX IDX_590C103A4AEAFEA (entreprise_id), INDEX IDX_590C103CFE419E2 (cv_id), INDEX IDX_590C103A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience_informations_generales (id INT AUTO_INCREMENT NOT NULL, intitule_poste VARCHAR(150) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, en_cours TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(150) NOT NULL, template_path VARCHAR(255) DEFAULT NULL, css_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', enabled TINYINT(1) NOT NULL, token_inscription VARCHAR(255) DEFAULT NULL, avatar_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, pays VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE9259027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F4272FC9F FOREIGN KEY (domaine_id) REFERENCES competence_domaine (id)');
        $this->addSql('ALTER TABLE competence_domaine ADD CONSTRAINT FK_6CE7B5E6CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63852B5672F FOREIGN KEY (c_v_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10395220281 FOREIGN KEY (informations_generales_id) REFERENCES experience_informations_generales (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competence_domaine DROP FOREIGN KEY FK_6CE7B5E6CFE419E2');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63852B5672F');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103CFE419E2');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F4272FC9F');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103A4AEAFEA');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10395220281');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE9259027487');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92A76ED395');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A76ED395');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103A73F0036');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE competence_domaine');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE experience_informations_generales');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ville');
    }
}
