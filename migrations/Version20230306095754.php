<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306095754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E87A76ED395');
        $this->addSql('DROP INDEX UNIQ_3D247E87A76ED395 ON entraineur');
        $this->addSql('ALTER TABLE entraineur DROP user_id, DROP status, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E87BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6A76ED395');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6B706B6D3');
        $this->addSql('DROP INDEX IDX_23C0CAA6B706B6D3 ON nageur');
        $this->addSql('DROP INDEX UNIQ_23C0CAA6A76ED395 ON nageur');
        $this->addSql('ALTER TABLE nageur ADD parent_id INT NOT NULL, DROP user_id, DROP parents_id, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6727ACA70 FOREIGN KEY (parent_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_23C0CAA6727ACA70 ON nageur (parent_id)');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6AA76ED395');
        $this->addSql('DROP INDEX UNIQ_FD501D6AA76ED395 ON parents');
        $this->addSql('ALTER TABLE parents DROP user_id, DROP status, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6ABF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64946AFAA23');
        $this->addSql('DROP INDEX UNIQ_8D93D64946AFAA23 ON user');
        $this->addSql('ALTER TABLE user ADD status SMALLINT NOT NULL, ADD discr_type VARCHAR(255) NOT NULL, DROP entraineurs_id, DROP nageur, DROP parents, DROP entraineur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entraineur DROP FOREIGN KEY FK_3D247E87BF396750');
        $this->addSql('ALTER TABLE entraineur ADD user_id INT NOT NULL, ADD status VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE entraineur ADD CONSTRAINT FK_3D247E87A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D247E87A76ED395 ON entraineur (user_id)');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6ABF396750');
        $this->addSql('ALTER TABLE parents ADD user_id INT NOT NULL, ADD status VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD501D6AA76ED395 ON parents (user_id)');
        $this->addSql('ALTER TABLE user ADD entraineurs_id INT DEFAULT NULL, ADD nageur VARCHAR(255) DEFAULT NULL, ADD parents VARCHAR(255) DEFAULT NULL, ADD entraineur VARCHAR(255) DEFAULT NULL, DROP status, DROP discr_type');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64946AFAA23 FOREIGN KEY (entraineurs_id) REFERENCES entraineur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64946AFAA23 ON user (entraineurs_id)');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6727ACA70');
        $this->addSql('ALTER TABLE nageur DROP FOREIGN KEY FK_23C0CAA6BF396750');
        $this->addSql('DROP INDEX IDX_23C0CAA6727ACA70 ON nageur');
        $this->addSql('ALTER TABLE nageur ADD parents_id INT NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE parent_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE nageur ADD CONSTRAINT FK_23C0CAA6B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_23C0CAA6B706B6D3 ON nageur (parents_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23C0CAA6A76ED395 ON nageur (user_id)');
    }
}
