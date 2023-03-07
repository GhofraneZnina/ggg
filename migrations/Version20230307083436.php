<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307083436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entraineur (id INT NOT NULL, date_naissance DATE NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nageur (id INT NOT NULL, parent_id INT NOT NULL, num_licence VARCHAR(255) NOT NULL, date_licence VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, type_etablissement VARCHAR(255) NOT NULL, date_debut_activite_sprtive DATE NOT NULL, remarque VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, genre VARCHAR(255) NOT NULL, INDEX IDX_23C0CAA6727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, remarque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', status SMALLINT NOT NULL, profile_facebook VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) NOT NULL, discr_type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E87BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6727ACA70 FOREIGN KEY (parent_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6ABF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E87BF396750');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6727ACA70');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6BF396750');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6ABF396750');
        $this->addSql('DROP TABLE entraineur');
        $this->addSql('DROP TABLE nageur');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
