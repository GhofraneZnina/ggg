<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313075440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, duree VARCHAR(255) NOT NULL, categorie_age VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_nageur (categorie_id INT NOT NULL, nageur_id INT NOT NULL, INDEX IDX_A5E6609FBCF5E72D (categorie_id), INDEX IDX_A5E6609F11C519B5 (nageur_id), PRIMARY KEY(categorie_id, nageur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_nageur ADD CONSTRAINT FK_A5E6609FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_nageur ADD CONSTRAINT FK_A5E6609F11C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nageur CHANGE date_licence date_licence DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_nageur DROP FOREIGN KEY FK_A5E6609FBCF5E72D');
        $this->addSql('ALTER TABLE categorie_nageur DROP FOREIGN KEY FK_A5E6609F11C519B5');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_nageur');
        $this->addSql('ALTER TABLE nageur CHANGE date_licence date_licence VARCHAR(255) NOT NULL');
    }
}
