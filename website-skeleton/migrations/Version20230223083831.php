<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223083831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nageur_categorie (nageur_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_9BDE05F11C519B5 (nageur_id), INDEX IDX_9BDE05FBCF5E72D (categorie_id), PRIMARY KEY(nageur_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nageur_cotisation_annuelle (nageur_id INT NOT NULL, cotisation_annuelle_id INT NOT NULL, INDEX IDX_AF6CF32C11C519B5 (nageur_id), INDEX IDX_AF6CF32C1BE38DF (cotisation_annuelle_id), PRIMARY KEY(nageur_id, cotisation_annuelle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nageur_categorie ADD CONSTRAINT FK_9BDE05F11C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nageur_categorie ADD CONSTRAINT FK_9BDE05FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nageur_cotisation_annuelle ADD CONSTRAINT FK_AF6CF32C11C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nageur_cotisation_annuelle ADD CONSTRAINT FK_AF6CF32C1BE38DF FOREIGN KEY (cotisation_annuelle_id) REFERENCES cotisation_annuelle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entraineur DROP telephone, DROP email, DROP password, DROP nom, DROP prenom, DROP profil_facebook');
        $this->addSql('ALTER TABLE groupe ADD entraineur_id INT NOT NULL');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21F8478A1 FOREIGN KEY (entraineur_id) REFERENCES entraineur (id)');
        $this->addSql('CREATE INDEX IDX_4B98C21F8478A1 ON groupe (entraineur_id)');
        $this->addSql('ALTER TABLE nageur ADD parent_id INT DEFAULT NULL, ADD groupe_id INT NOT NULL, ADD physionomie_id INT NOT NULL, ADD parents_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6727ACA70 FOREIGN KEY (parent_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA67A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA61200B1C7 FOREIGN KEY (physionomie_id) REFERENCES physionomie (id)');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23C0CAA6727ACA70 ON nageur (parent_id)');
        $this->addSql('CREATE INDEX IDX_23C0CAA67A45358C ON nageur (groupe_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23C0CAA61200B1C7 ON nageur (physionomie_id)');
        $this->addSql('CREATE INDEX IDX_23C0CAA6B706B6D3 ON nageur (parents_id)');
        $this->addSql('ALTER TABLE presence ADD nageur_id INT NOT NULL');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A511C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id)');
        $this->addSql('CREATE INDEX IDX_6977C7A511C519B5 ON presence (nageur_id)');
        $this->addSql('ALTER TABLE resultat ADD nageur_id INT NOT NULL');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE211C519B5 FOREIGN KEY (nageur_id) REFERENCES nageur (id)');
        $this->addSql('CREATE INDEX IDX_E7DB5DE211C519B5 ON resultat (nageur_id)');
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
        $this->addSql('ALTER TABLE nageur_categorie DROP FOREIGN KEY FK_9BDE05F11C519B5');
        $this->addSql('ALTER TABLE nageur_categorie DROP FOREIGN KEY FK_9BDE05FBCF5E72D');
        $this->addSql('ALTER TABLE nageur_cotisation_annuelle DROP FOREIGN KEY FK_AF6CF32C11C519B5');
        $this->addSql('ALTER TABLE nageur_cotisation_annuelle DROP FOREIGN KEY FK_AF6CF32C1BE38DF');
        $this->addSql('DROP TABLE nageur_categorie');
        $this->addSql('DROP TABLE nageur_cotisation_annuelle');
        $this->addSql('ALTER TABLE entraineur ADD telephone VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD profil_facebook VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21F8478A1');
        $this->addSql('DROP INDEX IDX_4B98C21F8478A1 ON groupe');
        $this->addSql('ALTER TABLE groupe DROP entraineur_id');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6727ACA70');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA67A45358C');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA61200B1C7');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6B706B6D3');
        $this->addSql('DROP INDEX UNIQ_23C0CAA6727ACA70 ON nageur');
        $this->addSql('DROP INDEX IDX_23C0CAA67A45358C ON nageur');
        $this->addSql('DROP INDEX UNIQ_23C0CAA61200B1C7 ON nageur');
        $this->addSql('DROP INDEX IDX_23C0CAA6B706B6D3 ON nageur');
        $this->addSql('ALTER TABLE nageur DROP parent_id, DROP groupe_id, DROP physionomie_id, DROP parents_id');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A511C519B5');
        $this->addSql('DROP INDEX IDX_6977C7A511C519B5 ON presence');
        $this->addSql('ALTER TABLE presence DROP nageur_id');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE211C519B5');
        $this->addSql('DROP INDEX IDX_E7DB5DE211C519B5 ON resultat');
        $this->addSql('ALTER TABLE resultat DROP nageur_id');
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
