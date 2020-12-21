<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201215082956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasks CHANGE delivery_date delivery_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE tasks CHANGE id id INT NOT NULL auto_increment FIRST, CHANGE user_id user_id INT NOT NULL AFTER id, CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER user_id, CHANGE content content LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER title, CHANGE hours hours INT NULL DEFAULT NULL AFTER content, CHANGE priority priority VARCHAR(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER hours, CHANGE delivery_date delivery_date DATETIME NULL DEFAULT NULL AFTER completed');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasks CHANGE delivery_date delivery_date DATETIME DEFAULT NULL');
    }
}
