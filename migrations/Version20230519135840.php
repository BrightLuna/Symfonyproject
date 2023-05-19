<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519135840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD COLUMN whitelisted BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, steam_id, profileurl, avatar, avatarmedium, avatarfull FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , steam_id INTEGER NOT NULL, profileurl VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, avatarmedium VARCHAR(255) DEFAULT NULL, avatarfull VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, username, roles, steam_id, profileurl, avatar, avatarmedium, avatarfull) SELECT id, username, roles, steam_id, profileurl, avatar, avatarmedium, avatarfull FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
