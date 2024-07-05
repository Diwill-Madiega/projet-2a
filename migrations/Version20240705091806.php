<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240705091806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buy_order_line DROP CONSTRAINT fk_361989c4aab58ebc');
        $this->addSql('DROP INDEX idx_361989c4aab58ebc');
        $this->addSql('ALTER TABLE buy_order_line DROP furnisher_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE buy_order_line ADD furnisher_id INT NOT NULL');
        $this->addSql('ALTER TABLE buy_order_line ADD CONSTRAINT fk_361989c4aab58ebc FOREIGN KEY (furnisher_id) REFERENCES furnisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_361989c4aab58ebc ON buy_order_line (furnisher_id)');
    }
}
