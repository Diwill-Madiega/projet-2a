<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703133251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buy_order ADD furnisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE buy_order ADD CONSTRAINT FK_C70F6927AAB58EBC FOREIGN KEY (furnisher_id) REFERENCES furnisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C70F6927AAB58EBC ON buy_order (furnisher_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE buy_order DROP CONSTRAINT FK_C70F6927AAB58EBC');
        $this->addSql('DROP INDEX IDX_C70F6927AAB58EBC');
        $this->addSql('ALTER TABLE buy_order DROP furnisher_id');
    }
}
