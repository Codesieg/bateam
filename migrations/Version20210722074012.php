<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722074012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE materiels (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, nom_court VARCHAR(255) DEFAULT NULL, marque VARCHAR(255) DEFAULT NULL, prix_public VARCHAR(255) DEFAULT NULL, reference_fabricant VARCHAR(255) DEFAULT NULL, INDEX IDX_9C1EBE69C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metiers (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types (id INT AUTO_INCREMENT NOT NULL, metier_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_59308930ED16FA20 (metier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE materiels ADD CONSTRAINT FK_9C1EBE69C54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE types ADD CONSTRAINT FK_59308930ED16FA20 FOREIGN KEY (metier_id) REFERENCES metiers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE types DROP FOREIGN KEY FK_59308930ED16FA20');
        $this->addSql('ALTER TABLE materiels DROP FOREIGN KEY FK_9C1EBE69C54C8C93');
        $this->addSql('DROP TABLE materiels');
        $this->addSql('DROP TABLE metiers');
        $this->addSql('DROP TABLE types');
    }
}
