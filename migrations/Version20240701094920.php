<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701094920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sell_order_line_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sell_order_line (id INT NOT NULL, piece_id INT NOT NULL, amount INT NOT NULL, price DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, detail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E5B4DF2FC40FCFA8 ON sell_order_line (piece_id)');
        $this->addSql('ALTER TABLE sell_order_line ADD CONSTRAINT FK_E5B4DF2FC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE sell_order_line_id_seq CASCADE');
        $this->addSql('ALTER TABLE sell_order_line DROP CONSTRAINT FK_E5B4DF2FC40FCFA8');
        $this->addSql('DROP TABLE sell_order_line');
    }
}
