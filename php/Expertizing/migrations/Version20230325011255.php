<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230325011255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asset ADD district_id INT NOT NULL');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CB08FA272 FOREIGN KEY (district_id) REFERENCES district (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2AF5A5CB08FA272 ON asset (district_id)');
        $this->addSql('ALTER TABLE district ADD province_state_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE district ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C154878A6AEA9B FOREIGN KEY (province_state_id) REFERENCES province_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_31C154878A6AEA9B ON district (province_state_id)');
        $this->addSql('ALTER TABLE province_state ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE province_state ADD CONSTRAINT FK_BFD46D6F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BFD46D6F92F3E70 ON province_state (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE district DROP CONSTRAINT FK_31C154878A6AEA9B');
        $this->addSql('DROP INDEX IDX_31C154878A6AEA9B');
        $this->addSql('ALTER TABLE district DROP province_state_id');
        $this->addSql('ALTER TABLE district DROP name');
        $this->addSql('ALTER TABLE asset DROP CONSTRAINT FK_2AF5A5CB08FA272');
        $this->addSql('DROP INDEX IDX_2AF5A5CB08FA272');
        $this->addSql('ALTER TABLE asset DROP district_id');
        $this->addSql('ALTER TABLE province_state DROP CONSTRAINT FK_BFD46D6F92F3E70');
        $this->addSql('DROP INDEX IDX_BFD46D6F92F3E70');
        $this->addSql('ALTER TABLE province_state DROP country_id');
    }
}
