<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223093131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entraineur_presence (entraineur_id INT NOT NULL, presence_id INT NOT NULL, INDEX IDX_7F4F651DF8478A1 (entraineur_id), INDEX IDX_7F4F651DF328FFC4 (presence_id), PRIMARY KEY(entraineur_id, presence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entraineur_presence ADD CONSTRAINT FK_7F4F651DF8478A1 FOREIGN KEY (entraineur_id) REFERENCES entraineur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entraineur_presence ADD CONSTRAINT FK_7F4F651DF328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entraineur ADD groupe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E877A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_3D247E877A45358C ON entraineur (groupe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur_presence DROP FOREIGN KEY FK_7F4F651DF8478A1');
        $this->addSql('ALTER TABLE entraineur_presence DROP FOREIGN KEY FK_7F4F651DF328FFC4');
        $this->addSql('DROP TABLE entraineur_presence');
        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E877A45358C');
        $this->addSql('DROP INDEX IDX_3D247E877A45358C ON entraineur');
        $this->addSql('ALTER TABLE entraineur DROP groupe_id');
    }
}
