<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260313062548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add slug and timestamps to starship';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE starship ADD slug VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE starship DROP slug, DROP updated_at, DROP created_at');
    }
}
