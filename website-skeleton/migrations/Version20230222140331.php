<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222140331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nageur ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD profil_facebook VARCHAR(255) NOT NULL, ADD telephone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE parents ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD profil_facebook VARCHAR(255) NOT NULL, ADD telephone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nageur DROP email, DROP password, DROP nom, DROP prenom, DROP profil_facebook, DROP telephone');
        $this->addSql('ALTER TABLE parents DROP email, DROP password, DROP nom, DROP prenom, DROP profil_facebook, DROP telephone');
    }
}
