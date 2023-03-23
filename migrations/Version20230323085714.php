<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323085714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, add_by_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, price INTEGER NOT NULL, introduction VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, nb_room INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , image_url VARCHAR(255) NOT NULL, CONSTRAINT FK_CD632DF012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CD632DF017542AC5 FOREIGN KEY (add_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CD632DF012469DE2 ON appartment (category_id)');
        $this->addSql('CREATE INDEX IDX_CD632DF017542AC5 ON appartment (add_by_id)');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appartment');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
