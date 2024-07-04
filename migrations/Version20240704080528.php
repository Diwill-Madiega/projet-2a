<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704080528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sell_order ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE sell_order ADD CONSTRAINT FK_ED81DFC49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ED81DFC49395C3F3 ON sell_order (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sell_order DROP CONSTRAINT FK_ED81DFC49395C3F3');
        $this->addSql('DROP INDEX IDX_ED81DFC49395C3F3');
        $this->addSql('ALTER TABLE sell_order DROP customer_id');
    }
}
