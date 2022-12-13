<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210184043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7286E79CF');
        $this->addSql('DROP INDEX IDX_3BAE0AA7286E79CF ON event');
        $this->addSql('ALTER TABLE event CHANGE dance_classes_id dance_class_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA78AFDA0EB FOREIGN KEY (dance_class_id) REFERENCES dance_classes (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA78AFDA0EB ON event (dance_class_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA78AFDA0EB');
        $this->addSql('DROP INDEX IDX_3BAE0AA78AFDA0EB ON event');
        $this->addSql('ALTER TABLE event CHANGE dance_class_id dance_classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7286E79CF FOREIGN KEY (dance_classes_id) REFERENCES dance_classes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7286E79CF ON event (dance_classes_id)');
    }
}
