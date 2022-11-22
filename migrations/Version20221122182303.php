<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221122182303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recurringevent');
        $this->addSql('ALTER TABLE event_calendar ADD isRecurring INT NOT NULL, ADD strat_recur DATETIME DEFAULT NULL, ADD end_recur DATETIME DEFAULT NULL, DROP dtype');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recurringevent (id INT AUTO_INCREMENT NOT NULL, strat_recur DATETIME NOT NULL, end_recur DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_calendar ADD dtype VARCHAR(255) NOT NULL, DROP isRecurring, DROP strat_recur, DROP end_recur');
    }
}
