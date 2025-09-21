<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260427053903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add the user entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, first_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE starship_droid CHANGE assigned_at assigned_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE starship_droid RENAME INDEX idx_1c7fbe8810c08a12 TO IDX_1C7FBE889B24DF5');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE starship_droid CHANGE assigned_at assigned_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE starship_droid RENAME INDEX idx_1c7fbe889b24df5 TO IDX_1C7FBE8810C08A12');
    }
}
