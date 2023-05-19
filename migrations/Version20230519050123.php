<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230519050123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает таблицу стран и продуктов';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id UUID NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, tax INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN country.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product (id UUID NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE product');
    }
}
