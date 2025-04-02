<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402114705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE composicion_producto (id INT AUTO_INCREMENT NOT NULL, producto_id INT NOT NULL, ingrediente_id INT NOT NULL, cantidad_necesaria DOUBLE PRECISION NOT NULL, INDEX IDX_300C288E7645698E (producto_id), INDEX IDX_300C288E769E458D (ingrediente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingrediente (id INT AUTO_INCREMENT NOT NULL, unidad_medida_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, stock DOUBLE PRECISION NOT NULL, INDEX IDX_BFB4A41E2E003F4 (unidad_medida_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidad_medida (id INT AUTO_INCREMENT NOT NULL, unidad_medida VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composicion_producto ADD CONSTRAINT FK_300C288E7645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE composicion_producto ADD CONSTRAINT FK_300C288E769E458D FOREIGN KEY (ingrediente_id) REFERENCES ingrediente (id)');
        $this->addSql('ALTER TABLE ingrediente ADD CONSTRAINT FK_BFB4A41E2E003F4 FOREIGN KEY (unidad_medida_id) REFERENCES unidad_medida (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composicion_producto DROP FOREIGN KEY FK_300C288E7645698E');
        $this->addSql('ALTER TABLE composicion_producto DROP FOREIGN KEY FK_300C288E769E458D');
        $this->addSql('ALTER TABLE ingrediente DROP FOREIGN KEY FK_BFB4A41E2E003F4');
        $this->addSql('DROP TABLE composicion_producto');
        $this->addSql('DROP TABLE ingrediente');
        $this->addSql('DROP TABLE unidad_medida');
    }
}
