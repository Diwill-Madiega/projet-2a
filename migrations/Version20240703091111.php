<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703091111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis_line ADD devis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis_line ADD CONSTRAINT FK_9EC6D52941DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9EC6D52941DEFADA ON devis_line (devis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE devis_line DROP CONSTRAINT FK_9EC6D52941DEFADA');
        $this->addSql('DROP INDEX IDX_9EC6D52941DEFADA');
        $this->addSql('ALTER TABLE devis_line DROP devis_id');
    }
}
