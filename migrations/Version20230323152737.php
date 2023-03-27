<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323152737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, appartment_id INTEGER DEFAULT NULL, reserved_by_id INTEGER DEFAULT NULL, date_start DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , date_end DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , message VARCHAR(255) NOT NULL, CONSTRAINT FK_42C849552714DC20 FOREIGN KEY (appartment_id) REFERENCES appartment (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C84955BCDB4AF4 FOREIGN KEY (reserved_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_42C849552714DC20 ON reservation (appartment_id)');
        $this->addSql('CREATE INDEX IDX_42C84955BCDB4AF4 ON reservation (reserved_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation');
    }
}
