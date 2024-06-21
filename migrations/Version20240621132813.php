<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621132813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE production_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE production (id INT NOT NULL, post_id INT NOT NULL, machine_id INT NOT NULL, name VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, duration INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D3EDB1E04B89032C ON production (post_id)');
        $this->addSql('CREATE INDEX IDX_D3EDB1E0F6B75B26 ON production (machine_id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E04B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE production_id_seq CASCADE');
        $this->addSql('ALTER TABLE production DROP CONSTRAINT FK_D3EDB1E04B89032C');
        $this->addSql('ALTER TABLE production DROP CONSTRAINT FK_D3EDB1E0F6B75B26');
        $this->addSql('DROP TABLE production');
    }
}
