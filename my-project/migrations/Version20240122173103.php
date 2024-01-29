<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122173103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ciudad (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cliente ADD ciudad VARCHAR(255) NOT NULL, ADD estado VARCHAR(2) DEFAULT NULL, ADD cod_postal INT NOT NULL, ADD area INT DEFAULT NULL, ADD telefono VARCHAR(255) NOT NULL, ADD limite_credito DOUBLE PRECISION NOT NULL, ADD observaciones VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ciudad');
        $this->addSql('ALTER TABLE cliente DROP ciudad, DROP estado, DROP cod_postal, DROP area, DROP telefono, DROP limite_credito, DROP observaciones');
    }
}
