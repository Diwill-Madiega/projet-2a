<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627135805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE buy_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE buy_order (id INT NOT NULL, furnisher_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, amount INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C70F6927AAB58EBC ON buy_order (furnisher_id)');
        $this->addSql('ALTER TABLE buy_order ADD CONSTRAINT FK_C70F6927AAB58EBC FOREIGN KEY (furnisher_id) REFERENCES furnisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE buy_order_id_seq CASCADE');
        $this->addSql('ALTER TABLE buy_order DROP CONSTRAINT FK_C70F6927AAB58EBC');
        $this->addSql('DROP TABLE buy_order');
    }
}
