<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324235721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset ADD type VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER INDEX idx_2af5a5c9d86650f RENAME TO IDX_2AF5A5CA76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE asset DROP type');
        $this->addSql('ALTER INDEX idx_2af5a5ca76ed395 RENAME TO idx_2af5a5c9d86650f');
    }
}
