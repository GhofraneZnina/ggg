<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222132843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE programme_competition (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(255) NOT NULL, horaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, profil_facebook VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entraineur DROP profil_facebook');
        $this->addSql('ALTER TABLE parents DROP telephone, DROP profil_facebook');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE programme_competition');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE entraineur ADD profil_facebook VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE parents ADD telephone VARCHAR(255) NOT NULL, ADD profil_facebook VARCHAR(255) DEFAULT NULL');
    }
}
