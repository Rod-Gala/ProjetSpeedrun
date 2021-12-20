<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206090634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE run DROP FOREIGN KEY FK_5076A4C09777D11E');
        $this->addSql('ALTER TABLE run DROP FOREIGN KEY FK_5076A4C09D86650F');
        $this->addSql('DROP INDEX IDX_5076A4C09777D11E ON run');
        $this->addSql('DROP INDEX IDX_5076A4C09D86650F ON run');
        $this->addSql('ALTER TABLE run ADD category_id INT NOT NULL, ADD user_id INT NOT NULL, DROP category_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE run ADD CONSTRAINT FK_5076A4C012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE run ADD CONSTRAINT FK_5076A4C0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5076A4C012469DE2 ON run (category_id)');
        $this->addSql('CREATE INDEX IDX_5076A4C0A76ED395 ON run (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE run DROP FOREIGN KEY FK_5076A4C012469DE2');
        $this->addSql('ALTER TABLE run DROP FOREIGN KEY FK_5076A4C0A76ED395');
        $this->addSql('DROP INDEX IDX_5076A4C012469DE2 ON run');
        $this->addSql('DROP INDEX IDX_5076A4C0A76ED395 ON run');
        $this->addSql('ALTER TABLE run ADD category_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP category_id, DROP user_id');
        $this->addSql('ALTER TABLE run ADD CONSTRAINT FK_5076A4C09777D11E FOREIGN KEY (category_id_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE run ADD CONSTRAINT FK_5076A4C09D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5076A4C09777D11E ON run (category_id_id)');
        $this->addSql('CREATE INDEX IDX_5076A4C09D86650F ON run (user_id_id)');
    }
}
