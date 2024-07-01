<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701085500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buy_order DROP price');
        $this->addSql('ALTER TABLE buy_order DROP amount');
        $this->addSql('ALTER TABLE buy_order DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE buy_order ADD price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE buy_order ADD amount INT NOT NULL');
        $this->addSql('ALTER TABLE buy_order ADD type VARCHAR(255) NOT NULL');
    }
}
