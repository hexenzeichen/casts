<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260306070026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add starship table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE starship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, captain VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, arrived_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE starship');
    }
}
