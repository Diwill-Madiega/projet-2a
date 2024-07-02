<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702101643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sell_order_line ADD sell_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE sell_order_line ADD CONSTRAINT FK_E5B4DF2F6CF89127 FOREIGN KEY (sell_order_id) REFERENCES sell_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E5B4DF2F6CF89127 ON sell_order_line (sell_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sell_order_line DROP CONSTRAINT FK_E5B4DF2F6CF89127');
        $this->addSql('DROP INDEX IDX_E5B4DF2F6CF89127');
        $this->addSql('ALTER TABLE sell_order_line DROP sell_order_id');
    }
}
