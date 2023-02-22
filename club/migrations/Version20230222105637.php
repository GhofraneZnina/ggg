<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222105637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nageuur (id INT AUTO_INCREMENT NOT NULL, num_licence VARCHAR(255) NOT NULL, date_licence DATE NOT NULL, photo VARCHAR(255) NOT NULL, date_debut_activite_sportive DATE NOT NULL, remarque VARCHAR(255) NOT NULL, profil_facebook VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE nageuur');
    }
}
