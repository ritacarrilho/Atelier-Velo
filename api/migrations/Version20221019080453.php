<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221019080453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bicycle (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, type_id INT NOT NULL, size_id INT DEFAULT NULL, model VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, tires_condition INT NOT NULL, breaks_condition INT NOT NULL, gears_condition INT NOT NULL, price DOUBLE PRECISION NOT NULL, disponibility TINYINT(1) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_D81AFAAE12469DE2 (category_id), INDEX IDX_D81AFAAEC54C8C93 (type_id), INDEX IDX_D81AFAAE498DA827 (size_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bicycle_size (id INT AUTO_INCREMENT NOT NULL, size VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bicycle_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, event_date DATETIME NOT NULL, image VARCHAR(150) NOT NULL, INDEX IDX_3BAE0AA79777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, model VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD9777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscriber (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, first_name VARCHAR(150) NOT NULL, last_name VARCHAR(150) NOT NULL, phone VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_AD005B69D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscriber_role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, subscriber_role_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649C48A9E2B (subscriber_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bicycle ADD CONSTRAINT FK_D81AFAAE12469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE bicycle ADD CONSTRAINT FK_D81AFAAEC54C8C93 FOREIGN KEY (type_id) REFERENCES bicycle_type (id)');
        $this->addSql('ALTER TABLE bicycle ADD CONSTRAINT FK_D81AFAAE498DA827 FOREIGN KEY (size_id) REFERENCES bicycle_size (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA79777D11E FOREIGN KEY (category_id_id) REFERENCES event_category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9777D11E FOREIGN KEY (category_id_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE subscriber ADD CONSTRAINT FK_AD005B69D60322AC FOREIGN KEY (role_id) REFERENCES subscriber_role (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C48A9E2B FOREIGN KEY (subscriber_role_id) REFERENCES subscriber_role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bicycle DROP FOREIGN KEY FK_D81AFAAE12469DE2');
        $this->addSql('ALTER TABLE bicycle DROP FOREIGN KEY FK_D81AFAAEC54C8C93');
        $this->addSql('ALTER TABLE bicycle DROP FOREIGN KEY FK_D81AFAAE498DA827');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA79777D11E');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9777D11E');
        $this->addSql('ALTER TABLE subscriber DROP FOREIGN KEY FK_AD005B69D60322AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C48A9E2B');
        $this->addSql('DROP TABLE bicycle');
        $this->addSql('DROP TABLE bicycle_size');
        $this->addSql('DROP TABLE bicycle_type');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE subscriber');
        $this->addSql('DROP TABLE subscriber_role');
        $this->addSql('DROP TABLE user');
    }
}
