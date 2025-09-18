<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260419175518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add the relation between droids and starships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE starship_droid (starship_id INT NOT NULL, droid_id INT NOT NULL, INDEX IDX_1C7FBE889B24DF5 (starship_id), INDEX IDX_1C7FBE88AB064EF (droid_id), PRIMARY KEY (starship_id, droid_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT FK_1C7FBE889B24DF5 FOREIGN KEY (starship_id) REFERENCES starship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT FK_1C7FBE88AB064EF FOREIGN KEY (droid_id) REFERENCES droid (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE starship_droid DROP FOREIGN KEY FK_1C7FBE889B24DF5');
        $this->addSql('ALTER TABLE starship_droid DROP FOREIGN KEY FK_1C7FBE88AB064EF');
        $this->addSql('DROP TABLE starship_droid');
    }
}
