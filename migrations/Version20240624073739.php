<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624073739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE operation_machine (operation_id INT NOT NULL, machine_id INT NOT NULL, PRIMARY KEY(operation_id, machine_id))');
        $this->addSql('CREATE INDEX IDX_B6C45F4944AC3583 ON operation_machine (operation_id)');
        $this->addSql('CREATE INDEX IDX_B6C45F49F6B75B26 ON operation_machine (machine_id)');
        $this->addSql('ALTER TABLE operation_machine ADD CONSTRAINT FK_B6C45F4944AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation_machine ADD CONSTRAINT FK_B6C45F49F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1981A66D4B89032C ON operation (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE operation_machine DROP CONSTRAINT FK_B6C45F4944AC3583');
        $this->addSql('ALTER TABLE operation_machine DROP CONSTRAINT FK_B6C45F49F6B75B26');
        $this->addSql('DROP TABLE operation_machine');
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT FK_1981A66D4B89032C');
        $this->addSql('DROP INDEX IDX_1981A66D4B89032C');
        $this->addSql('ALTER TABLE operation DROP post_id');
    }
}
