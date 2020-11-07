<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201101210720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about_us (id INT AUTO_INCREMENT NOT NULL, about_image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, introduction LONGTEXT NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, mission LONGTEXT DEFAULT NULL, vision LONGTEXT DEFAULT NULL, INDEX IDX_B52303C371BB2404 (about_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE about_us ADD CONSTRAINT FK_B52303C371BB2404 FOREIGN KEY (about_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE ad ADD filename VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE about_us');
        $this->addSql('ALTER TABLE ad DROP filename');
    }
}
