<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701092511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE devis_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE devis (id INT NOT NULL, customer_id INT NOT NULL, name VARCHAR(255) NOT NULL, create_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deadline TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, total_cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8B27C52B9395C3F3 ON devis (customer_id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE devis_id_seq CASCADE');
        $this->addSql('ALTER TABLE devis DROP CONSTRAINT FK_8B27C52B9395C3F3');
        $this->addSql('DROP TABLE devis');
    }
}
