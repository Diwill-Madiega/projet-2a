<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619123541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE gamme_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gamme (id INT NOT NULL, owner_id INT NOT NULL, piece_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C32E14687E3C61F9 ON gamme (owner_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C32E1468C40FCFA8 ON gamme (piece_id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E14687E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE gamme_id_seq CASCADE');
        $this->addSql('ALTER TABLE gamme DROP CONSTRAINT FK_C32E14687E3C61F9');
        $this->addSql('ALTER TABLE gamme DROP CONSTRAINT FK_C32E1468C40FCFA8');
        $this->addSql('DROP TABLE gamme');
    }
}
