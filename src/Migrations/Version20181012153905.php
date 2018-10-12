<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181012153905 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cv CHANGE situation_professionnelle situation_professionnelle ENUM(\'EN_POSTE\', \'EN_FIN_DE_CONTRAT\', \'EN_RECHERCHE_EMPLOI\', \'FREELANCE\', \'CONSULTANT\', \'ENTREPRENEUR\', \'PORTEUR_DE_PROJET\', \'ETUDIANT\', \'EN_FIN_ETUDE\', \'STAGIAIRE\', \'APPRENTI\', \'EN_ALTERNANCE\') DEFAULT NULL COMMENT \'(DC2Type:SituationProfessionnelleEnumType)\', CHANGE disponibilite disponibilite ENUM(\'RECHERCHE_ACTIVE\', \'RECHERCHE_STAGE\', \'SIMPLE_VEILLE\', \'OPPORTUNITE\', \'INDISPONIBLE\') DEFAULT NULL COMMENT \'(DC2Type:DisponibiliteEnumType)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cv CHANGE situation_professionnelle situation_professionnelle LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:simple_array)\', CHANGE disponibilite disponibilite LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:simple_array)\'');
    }
}
