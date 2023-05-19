<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230519050818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Заполняет данными таблицу стран и продуктов';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO country (id, name, code, tax) VALUES (gen_random_uuid(), 'Германия', 'DE', 19)");
        $this->addSql("INSERT INTO country (id, name, code, tax) VALUES (gen_random_uuid(), 'Италия', 'IT', 22)");
        $this->addSql("INSERT INTO country (id, name, code, tax) VALUES (gen_random_uuid(), 'Греция', 'GR', 24)");
        $this->addSql("INSERT INTO product (id, name, price) VALUES (gen_random_uuid(), 'наушники', 100)");
        $this->addSql("INSERT INTO product (id, name, price) VALUES (gen_random_uuid(), 'чехол для телефона', 20)");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM country WHERE code IN ('DE', 'IT', 'GR')");
        $this->addSql("DELETE FROM product WHERE price IN (100, 20)");
    }
}
