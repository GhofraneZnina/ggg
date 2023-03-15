<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315142407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nage ADD id INT AUTO_INCREMENT NOT NULL, ADD label VARCHAR(255) NOT NULL, DROP crawl, DROP pap, DROP nl, DROP dos, DROP br, DROP n, DROP nl mix, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE nageur ADD groupe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA67A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_23C0CAA67A45358C ON nageur (groupe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nage MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON nage');
        $this->addSql('ALTER TABLE nage ADD pap VARCHAR(255) NOT NULL, ADD nl VARCHAR(255) NOT NULL, ADD dos VARCHAR(255) NOT NULL, ADD br VARCHAR(255) NOT NULL, ADD n VARCHAR(255) NOT NULL, ADD nl mix VARCHAR(255) NOT NULL, DROP id, CHANGE label crawl VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA67A45358C');
        $this->addSql('DROP INDEX IDX_23C0CAA67A45358C ON nageur');
        $this->addSql('ALTER TABLE nageur DROP groupe_id');
    }
}
