<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530190741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alergeno (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingrediente_alergeno (ingrediente_id INT NOT NULL, alergeno_id INT NOT NULL, INDEX IDX_7BA377EC769E458D (ingrediente_id), INDEX IDX_7BA377EC3E89035 (alergeno_id), PRIMARY KEY(ingrediente_id, alergeno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingrediente_alergeno ADD CONSTRAINT FK_7BA377EC769E458D FOREIGN KEY (ingrediente_id) REFERENCES ingrediente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingrediente_alergeno ADD CONSTRAINT FK_7BA377EC3E89035 FOREIGN KEY (alergeno_id) REFERENCES alergeno (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingrediente_alergeno DROP FOREIGN KEY FK_7BA377EC769E458D');
        $this->addSql('ALTER TABLE ingrediente_alergeno DROP FOREIGN KEY FK_7BA377EC3E89035');
        $this->addSql('DROP TABLE alergeno');
        $this->addSql('DROP TABLE ingrediente_alergeno');
    }
}
