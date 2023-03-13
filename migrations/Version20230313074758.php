<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313074758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE physionomie (id INT AUTO_INCREMENT NOT NULL, nageur_id INT NOT NULL, date DATE NOT NULL, taille DOUBLE PRECISION NOT NULL, poids DOUBLE PRECISION NOT NULL, INDEX IDX_4269C3EC11C519B5 (nageur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE physionomie ADD CONSTRAINT FK_4269C3EC11C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id)');
        $this->addSql('ALTER TABLE nageur CHANGE date_licence date_licence DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE physionomie DROP FOREIGN KEY FK_4269C3EC11C519B5');
        $this->addSql('DROP TABLE physionomie');
        $this->addSql('ALTER TABLE nageur CHANGE date_licence date_licence VARCHAR(255) NOT NULL');
    }
}
