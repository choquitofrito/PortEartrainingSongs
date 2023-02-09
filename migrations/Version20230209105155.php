<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209105155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_A18098BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE song (id INT AUTO_INCREMENT NOT NULL, library_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, original_tempo INT DEFAULT NULL, original_tonality VARCHAR(5) DEFAULT NULL, INDEX IDX_33EDEEA1FE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE study_status (id INT AUTO_INCREMENT NOT NULL, song_id INT NOT NULL, user_id INT DEFAULT NULL, tempo_tonality JSON DEFAULT NULL, INDEX IDX_DB55FD34A0BDB2F3 (song_id), INDEX IDX_DB55FD34A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE library ADD CONSTRAINT FK_A18098BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA1FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)');
        $this->addSql('ALTER TABLE study_status ADD CONSTRAINT FK_DB55FD34A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('ALTER TABLE study_status ADD CONSTRAINT FK_DB55FD34A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE library DROP FOREIGN KEY FK_A18098BCA76ED395');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA1FE2541D7');
        $this->addSql('ALTER TABLE study_status DROP FOREIGN KEY FK_DB55FD34A0BDB2F3');
        $this->addSql('ALTER TABLE study_status DROP FOREIGN KEY FK_DB55FD34A76ED395');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE song');
        $this->addSql('DROP TABLE study_status');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
