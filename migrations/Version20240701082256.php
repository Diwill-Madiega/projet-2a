<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701082256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE buy_order_line_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE buy_order_line (id INT NOT NULL, piece_id INT NOT NULL, furnisher_id INT NOT NULL, buy_order_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, amount INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_361989C4C40FCFA8 ON buy_order_line (piece_id)');
        $this->addSql('CREATE INDEX IDX_361989C4AAB58EBC ON buy_order_line (furnisher_id)');
        $this->addSql('CREATE INDEX IDX_361989C47FC358ED ON buy_order_line (buy_order_id)');
        $this->addSql('ALTER TABLE buy_order_line ADD CONSTRAINT FK_361989C4C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE buy_order_line ADD CONSTRAINT FK_361989C4AAB58EBC FOREIGN KEY (furnisher_id) REFERENCES furnisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE buy_order_line ADD CONSTRAINT FK_361989C47FC358ED FOREIGN KEY (buy_order_id) REFERENCES buy_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE buy_order_line_id_seq CASCADE');
        $this->addSql('ALTER TABLE buy_order_line DROP CONSTRAINT FK_361989C4C40FCFA8');
        $this->addSql('ALTER TABLE buy_order_line DROP CONSTRAINT FK_361989C4AAB58EBC');
        $this->addSql('ALTER TABLE buy_order_line DROP CONSTRAINT FK_361989C47FC358ED');
        $this->addSql('DROP TABLE buy_order_line');
    }
}
