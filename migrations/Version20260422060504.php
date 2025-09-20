<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260422060504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starship_droid DROP FOREIGN KEY `FK_1C7FBE88AB064EF`');
        $this->addSql('ALTER TABLE starship_droid DROP FOREIGN KEY `FK_1C7FBE889B24DF5`');
        $this->addSql('DROP INDEX IDX_1C7FBE889B24DF5 ON starship_droid');
        $this->addSql('ALTER TABLE starship_droid ADD id INT AUTO_INCREMENT NOT NULL, ADD assigned_at DATETIME DEFAULT NOW() NOT NULL, CHANGE starship_id starship_id INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT FK_1C7FBE88AB064EF FOREIGN KEY (droid_id) REFERENCES droid (id)');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT FK_1C7FBE8810C08A12 FOREIGN KEY (starship_id) REFERENCES starship (id)');
        $this->addSql('CREATE INDEX IDX_1C7FBE8810C08A12 ON starship_droid (starship_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starship_droid DROP FOREIGN KEY FK_1C7FBE88AB064EF');
        $this->addSql('ALTER TABLE starship_droid DROP FOREIGN KEY FK_1C7FBE8810C08A12');
        $this->addSql('DROP INDEX IDX_1C7FBE8810C08A12 ON starship_droid');
        $this->addSql('ALTER TABLE starship_droid MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE starship_droid DROP id, DROP assigned_at, CHANGE starship_id starship_id INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (starship_id, droid_id)');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT `FK_1C7FBE88AB064EF` FOREIGN KEY (droid_id) REFERENCES droid (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE starship_droid ADD CONSTRAINT `FK_1C7FBE889B24DF5` FOREIGN KEY (starship_id) REFERENCES starship (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1C7FBE889B24DF5 ON starship_droid (starship_id)');
    }
}
