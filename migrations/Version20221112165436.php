<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112165436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dance_classes DROP FOREIGN KEY FK_4FC8505AA40A2C8');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('ALTER TABLE dance_classes DROP FOREIGN KEY FK_4FC8505AA1C97148');
        $this->addSql('DROP INDEX IDX_4FC8505AA1C97148 ON dance_classes');
        $this->addSql('DROP INDEX IDX_4FC8505AA40A2C8 ON dance_classes');
        $this->addSql('ALTER TABLE dance_classes DROP calendar_id, DROP event_calendar_id');
        $this->addSql('ALTER TABLE event_calendar ADD dance_classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_calendar ADD CONSTRAINT FK_28454896286E79CF FOREIGN KEY (dance_classes_id) REFERENCES dance_classes (id)');
        $this->addSql('CREATE INDEX IDX_28454896286E79CF ON event_calendar (dance_classes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_all_day TINYINT(1) NOT NULL, background_color VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dance_classes ADD calendar_id INT DEFAULT NULL, ADD event_calendar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dance_classes ADD CONSTRAINT FK_4FC8505AA1C97148 FOREIGN KEY (event_calendar_id) REFERENCES event_calendar (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE dance_classes ADD CONSTRAINT FK_4FC8505AA40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4FC8505AA1C97148 ON dance_classes (event_calendar_id)');
        $this->addSql('CREATE INDEX IDX_4FC8505AA40A2C8 ON dance_classes (calendar_id)');
        $this->addSql('ALTER TABLE event_calendar DROP FOREIGN KEY FK_28454896286E79CF');
        $this->addSql('DROP INDEX IDX_28454896286E79CF ON event_calendar');
        $this->addSql('ALTER TABLE event_calendar DROP dance_classes_id');
    }
}
