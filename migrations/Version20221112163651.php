<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112163651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, is_all_day TINYINT(1) NOT NULL, background_color VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dance_classes ADD event_calendar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dance_classes ADD CONSTRAINT FK_4FC8505AA1C97148 FOREIGN KEY (event_calendar_id) REFERENCES event_calendar (id)');
        $this->addSql('CREATE INDEX IDX_4FC8505AA1C97148 ON dance_classes (event_calendar_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dance_classes DROP FOREIGN KEY FK_4FC8505AA1C97148');
        $this->addSql('DROP TABLE event_calendar');
        $this->addSql('DROP INDEX IDX_4FC8505AA1C97148 ON dance_classes');
        $this->addSql('ALTER TABLE dance_classes DROP event_calendar_id');
    }
}
