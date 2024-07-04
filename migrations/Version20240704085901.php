<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704085901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis_line DROP CONSTRAINT fk_9ec6d5299395c3f3');
        $this->addSql('DROP INDEX idx_9ec6d5299395c3f3');
        $this->addSql('ALTER TABLE devis_line ADD piece_id INT NOT NULL');
        $this->addSql('ALTER TABLE devis_line ADD amount INT NOT NULL');
        $this->addSql('ALTER TABLE devis_line ADD price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE devis_line DROP name');
        $this->addSql('ALTER TABLE devis_line RENAME COLUMN customer_id TO devis_id');
        $this->addSql('ALTER TABLE devis_line ADD CONSTRAINT FK_9EC6D529C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE devis_line ADD CONSTRAINT FK_9EC6D52941DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9EC6D529C40FCFA8 ON devis_line (piece_id)');
        $this->addSql('CREATE INDEX IDX_9EC6D52941DEFADA ON devis_line (devis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE devis_line DROP CONSTRAINT FK_9EC6D529C40FCFA8');
        $this->addSql('ALTER TABLE devis_line DROP CONSTRAINT FK_9EC6D52941DEFADA');
        $this->addSql('DROP INDEX IDX_9EC6D529C40FCFA8');
        $this->addSql('DROP INDEX IDX_9EC6D52941DEFADA');
        $this->addSql('ALTER TABLE devis_line ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE devis_line DROP piece_id');
        $this->addSql('ALTER TABLE devis_line DROP amount');
        $this->addSql('ALTER TABLE devis_line DROP price');
        $this->addSql('ALTER TABLE devis_line RENAME COLUMN devis_id TO customer_id');
        $this->addSql('ALTER TABLE devis_line ADD CONSTRAINT fk_9ec6d5299395c3f3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9ec6d5299395c3f3 ON devis_line (customer_id)');
    }
}
