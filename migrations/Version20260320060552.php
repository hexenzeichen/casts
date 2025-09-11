<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260320060552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add starship_part table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE starship_part (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, notes LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE starship_part');
    }
}
