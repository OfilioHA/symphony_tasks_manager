<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505223137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE task (id INT NOT NULL, task_father_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, priority INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB255F7F74F3 ON task (task_father_id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB255F7F74F3 FOREIGN KEY (task_father_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE task_id_seq CASCADE');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB255F7F74F3');
        $this->addSql('DROP TABLE task');
    }
}
