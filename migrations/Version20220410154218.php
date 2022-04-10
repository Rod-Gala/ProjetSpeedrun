<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410154218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE run ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE run ADD CONSTRAINT FK_5076A4C0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_5076A4C0BCF5E72D ON run (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE run DROP FOREIGN KEY FK_5076A4C0BCF5E72D');
        $this->addSql('DROP INDEX IDX_5076A4C0BCF5E72D ON run');
        $this->addSql('ALTER TABLE run DROP categorie_id');
    }
}
