<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181011173456 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competence_domaine ADD cv_id INT NOT NULL');
        $this->addSql('ALTER TABLE competence_domaine ADD CONSTRAINT FK_6CE7B5E6CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('CREATE INDEX IDX_6CE7B5E6CFE419E2 ON competence_domaine (cv_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competence_domaine DROP FOREIGN KEY FK_6CE7B5E6CFE419E2');
        $this->addSql('DROP INDEX IDX_6CE7B5E6CFE419E2 ON competence_domaine');
        $this->addSql('ALTER TABLE competence_domaine DROP cv_id');
    }
}
