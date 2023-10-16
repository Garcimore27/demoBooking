<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231016212438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, event_type_id INT DEFAULT NULL, status_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, total_price DOUBLE PRECISION NOT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_E00CEDDE54177093 (room_id), INDEX IDX_E00CEDDE401B253C (event_type_id), INDEX IDX_E00CEDDE6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_5A8600B0C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, address VARCHAR(255) NOT NULL, capacity INT NOT NULL, day_price DOUBLE PRECISION NOT NULL, is_rentable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_option (room_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_1BC8C67154177093 (room_id), INDEX IDX_1BC8C671A7C41D6F (option_id), PRIMARY KEY(room_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, color VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0C54C8C93 FOREIGN KEY (type_id) REFERENCES type_option (id)');
        $this->addSql('ALTER TABLE room_option ADD CONSTRAINT FK_1BC8C67154177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_option ADD CONSTRAINT FK_1BC8C671A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE54177093');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE401B253C');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE6BF700BD');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0C54C8C93');
        $this->addSql('ALTER TABLE room_option DROP FOREIGN KEY FK_1BC8C67154177093');
        $this->addSql('ALTER TABLE room_option DROP FOREIGN KEY FK_1BC8C671A7C41D6F');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE event_type');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_option');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type_option');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
