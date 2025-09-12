<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260320061700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add timestampable fields to the starship_part';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE starship_part ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE starship_part DROP created_at, DROP updated_at');
    }
}
