<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122121522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dance_classes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, poster VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dance_teacher (id INT AUTO_INCREMENT NOT NULL, dance_classes_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, story LONGTEXT NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_FDD3884A286E79CF (dance_classes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_calendar (id INT AUTO_INCREMENT NOT NULL, dance_classes_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, is_all_day TINYINT(1) NOT NULL, background_color VARCHAR(7) NOT NULL, dtype VARCHAR(255) NOT NULL, INDEX IDX_28454896286E79CF (dance_classes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recurringevent (id INT AUTO_INCREMENT NOT NULL, strat_recur DATETIME NOT NULL, end_recur DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_message (id INT AUTO_INCREMENT NOT NULL, dance_classes_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, reason VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_EEB02E75286E79CF (dance_classes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dance_teacher ADD CONSTRAINT FK_FDD3884A286E79CF FOREIGN KEY (dance_classes_id) REFERENCES dance_classes (id)');
        $this->addSql('ALTER TABLE event_calendar ADD CONSTRAINT FK_28454896286E79CF FOREIGN KEY (dance_classes_id) REFERENCES dance_classes (id)');
        $this->addSql('ALTER TABLE user_message ADD CONSTRAINT FK_EEB02E75286E79CF FOREIGN KEY (dance_classes_id) REFERENCES dance_classes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dance_teacher DROP FOREIGN KEY FK_FDD3884A286E79CF');
        $this->addSql('ALTER TABLE event_calendar DROP FOREIGN KEY FK_28454896286E79CF');
        $this->addSql('ALTER TABLE user_message DROP FOREIGN KEY FK_EEB02E75286E79CF');
        $this->addSql('DROP TABLE dance_classes');
        $this->addSql('DROP TABLE dance_teacher');
        $this->addSql('DROP TABLE event_calendar');
        $this->addSql('DROP TABLE recurringevent');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_message');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
