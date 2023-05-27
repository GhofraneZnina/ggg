<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331015904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, categorie_age VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cotisation_annuelle (id INT AUTO_INCREMENT NOT NULL, nageur_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, statut_paiement TINYINT(1) NOT NULL, remarque VARCHAR(255) NOT NULL, INDEX IDX_E5ED87BD11C519B5 (nageur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu_entrainement (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cotisation_annuelle ADD CONSTRAINT FK_E5ED87BD11C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id)');
        $this->addSql('ALTER TABLE nageur ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_23C0CAA6BCF5E72D ON nageur (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6BCF5E72D');
        $this->addSql('ALTER TABLE cotisation_annuelle DROP FOREIGN KEY FK_E5ED87BD11C519B5');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE cotisation_annuelle');
        $this->addSql('DROP TABLE lieu_entrainement');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP INDEX IDX_23C0CAA6BCF5E72D ON nageur');
        $this->addSql('ALTER TABLE nageur DROP categorie_id');
    }
}
