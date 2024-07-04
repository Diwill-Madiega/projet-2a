<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704075528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sell_order_devis_line (sell_order_id INT NOT NULL, devis_line_id INT NOT NULL, PRIMARY KEY(sell_order_id, devis_line_id))');
        $this->addSql('CREATE INDEX IDX_2B1C8ADB6CF89127 ON sell_order_devis_line (sell_order_id)');
        $this->addSql('CREATE INDEX IDX_2B1C8ADBDF95EE1E ON sell_order_devis_line (devis_line_id)');
        $this->addSql('ALTER TABLE sell_order_devis_line ADD CONSTRAINT FK_2B1C8ADB6CF89127 FOREIGN KEY (sell_order_id) REFERENCES sell_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sell_order_devis_line ADD CONSTRAINT FK_2B1C8ADBDF95EE1E FOREIGN KEY (devis_line_id) REFERENCES devis_line (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sell_order_devis_line DROP CONSTRAINT FK_2B1C8ADB6CF89127');
        $this->addSql('ALTER TABLE sell_order_devis_line DROP CONSTRAINT FK_2B1C8ADBDF95EE1E');
        $this->addSql('DROP TABLE sell_order_devis_line');
    }
}
