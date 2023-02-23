<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223094213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE saison ADD cotisation_annuelle_id INT DEFAULT NULL, ADD planning_id INT DEFAULT NULL, ADD tableau_minimas_id INT DEFAULT NULL, ADD one_to_one VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D5861BE38DF FOREIGN KEY (cotisation_annuelle_id) REFERENCES cotisation_annuelle (id)');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D5863D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D5869B223B9D FOREIGN KEY (tableau_minimas_id) REFERENCES tableau_minimas (id)');
        $this->addSql('CREATE INDEX IDX_C0D0D5861BE38DF ON saison (cotisation_annuelle_id)');
        $this->addSql('CREATE INDEX IDX_C0D0D5863D865311 ON saison (planning_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0D0D5869B223B9D ON saison (tableau_minimas_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D5861BE38DF');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D5863D865311');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D5869B223B9D');
        $this->addSql('DROP INDEX IDX_C0D0D5861BE38DF ON saison');
        $this->addSql('DROP INDEX IDX_C0D0D5863D865311 ON saison');
        $this->addSql('DROP INDEX UNIQ_C0D0D5869B223B9D ON saison');
        $this->addSql('ALTER TABLE saison DROP cotisation_annuelle_id, DROP planning_id, DROP tableau_minimas_id, DROP one_to_one');
    }
}
