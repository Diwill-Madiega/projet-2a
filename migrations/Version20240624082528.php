<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624082528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE piece_piece (piece_source INT NOT NULL, piece_target INT NOT NULL, PRIMARY KEY(piece_source, piece_target))');
        $this->addSql('CREATE INDEX IDX_56798A4885F87422 ON piece_piece (piece_source)');
        $this->addSql('CREATE INDEX IDX_56798A489C1D24AD ON piece_piece (piece_target)');
        $this->addSql('ALTER TABLE piece_piece ADD CONSTRAINT FK_56798A4885F87422 FOREIGN KEY (piece_source) REFERENCES piece (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE piece_piece ADD CONSTRAINT FK_56798A489C1D24AD FOREIGN KEY (piece_target) REFERENCES piece (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE piece_piece DROP CONSTRAINT FK_56798A4885F87422');
        $this->addSql('ALTER TABLE piece_piece DROP CONSTRAINT FK_56798A489C1D24AD');
        $this->addSql('DROP TABLE piece_piece');
    }
}
