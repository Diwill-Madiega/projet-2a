<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620081835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_machine (post_id INT NOT NULL, machine_id INT NOT NULL, PRIMARY KEY(post_id, machine_id))');
        $this->addSql('CREATE INDEX IDX_28ED68B74B89032C ON post_machine (post_id)');
        $this->addSql('CREATE INDEX IDX_28ED68B7F6B75B26 ON post_machine (machine_id)');
        $this->addSql('ALTER TABLE post_machine ADD CONSTRAINT FK_28ED68B74B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_machine ADD CONSTRAINT FK_28ED68B7F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post_machine DROP CONSTRAINT FK_28ED68B74B89032C');
        $this->addSql('ALTER TABLE post_machine DROP CONSTRAINT FK_28ED68B7F6B75B26');
        $this->addSql('DROP TABLE post_machine');
    }
}
