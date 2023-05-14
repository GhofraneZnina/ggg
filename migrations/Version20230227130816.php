<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227130816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E87A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D247E87A76ED395 ON entraineur (user_id)');
        $this->addSql('ALTER TABLE nageur ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23C0CAA6A76ED395 ON nageur (user_id)');
        $this->addSql('ALTER TABLE parents ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD501D6AA76ED395 ON parents (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E87A76ED395');
        $this->addSql('DROP INDEX UNIQ_3D247E87A76ED395 ON entraineur');
        $this->addSql('ALTER TABLE entraineur DROP user_id');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6A76ED395');
        $this->addSql('DROP INDEX UNIQ_23C0CAA6A76ED395 ON nageur');
        $this->addSql('ALTER TABLE nageur DROP user_id');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6AA76ED395');
        $this->addSql('DROP INDEX UNIQ_FD501D6AA76ED395 ON parents');
        $this->addSql('ALTER TABLE parents DROP user_id');
    }
}
