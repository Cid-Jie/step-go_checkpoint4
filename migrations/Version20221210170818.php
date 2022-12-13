<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210170818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE repeated_event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, color VARCHAR(7) NOT NULL, description VARCHAR(255) NOT NULL, day_of_week VARCHAR(20) NOT NULL, start_hour INT NOT NULL, start_minute INT NOT NULL, end_hour INT NOT NULL, end_minute INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE event_planning');
        $this->addSql('ALTER TABLE event DROP timed');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_planning (id INT AUTO_INCREMENT NOT NULL, dance_classes_id INT DEFAULT NULL, days_of_week INT NOT NULL, hours_of_day INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_92755626286E79CF (dance_classes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_planning ADD CONSTRAINT FK_92755626286E79CF FOREIGN KEY (dance_classes_id) REFERENCES dance_classes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE repeated_event');
        $this->addSql('ALTER TABLE event ADD timed TINYINT(1) NOT NULL');
    }
}
