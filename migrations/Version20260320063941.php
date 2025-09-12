<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260320063941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add a relation betweeb starship and starship_part';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE starship_part ADD starship_id INT NOT NULL');
        $this->addSql('ALTER TABLE starship_part ADD CONSTRAINT FK_41C447379B24DF5 FOREIGN KEY (starship_id) REFERENCES starship (id)');
        $this->addSql('CREATE INDEX IDX_41C447379B24DF5 ON starship_part (starship_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE starship_part DROP FOREIGN KEY FK_41C447379B24DF5');
        $this->addSql('DROP INDEX IDX_41C447379B24DF5 ON starship_part');
        $this->addSql('ALTER TABLE starship_part DROP starship_id');
    }
}
