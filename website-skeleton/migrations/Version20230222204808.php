<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222204808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur DROP telephone, DROP email, DROP password, DROP nom, DROP prenom, DROP profil_facebook');
        $this->addSql('ALTER TABLE nageur ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6727ACA70 FOREIGN KEY (parent_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23C0CAA6727ACA70 ON nageur (parent_id)');
        $this->addSql('ALTER TABLE utilisateur ADD nageur_id INT DEFAULT NULL, ADD entraineur_id INT DEFAULT NULL, ADD parent_id INT DEFAULT NULL, ADD parents_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B311C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3F8478A1 FOREIGN KEY (entraineur_id) REFERENCES entraineur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3727ACA70 FOREIGN KEY (parent_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B311C519B5 ON utilisateur (nageur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3F8478A1 ON utilisateur (entraineur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3727ACA70 ON utilisateur (parent_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3B706B6D3 ON utilisateur (parents_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur ADD telephone VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD profil_facebook VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6727ACA70');
        $this->addSql('DROP INDEX UNIQ_23C0CAA6727ACA70 ON nageur');
        $this->addSql('ALTER TABLE nageur DROP parent_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B311C519B5');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3F8478A1');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3727ACA70');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3B706B6D3');
        $this->addSql('DROP INDEX UNIQ_1D1C63B311C519B5 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3F8478A1 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3727ACA70 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3B706B6D3 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP nageur_id, DROP entraineur_id, DROP parent_id, DROP parents_id');
    }
}
