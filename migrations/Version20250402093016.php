<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402093016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detalle_pedido_proveedor (id INT AUTO_INCREMENT NOT NULL, pedido_proveedor_id INT NOT NULL, producto_id INT NOT NULL, cantidad DOUBLE PRECISION NOT NULL, precio_unitario DOUBLE PRECISION NOT NULL, INDEX IDX_DF0CA032C9345071 (pedido_proveedor_id), INDEX IDX_DF0CA0327645698E (producto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedido_proveedor (id INT AUTO_INCREMENT NOT NULL, proveedor_id INT NOT NULL, fecha DATETIME NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_EDD478CCB305D73 (proveedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proveedor (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefono INT NOT NULL, direccion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detalle_pedido_proveedor ADD CONSTRAINT FK_DF0CA032C9345071 FOREIGN KEY (pedido_proveedor_id) REFERENCES pedido_proveedor (id)');
        $this->addSql('ALTER TABLE detalle_pedido_proveedor ADD CONSTRAINT FK_DF0CA0327645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE pedido_proveedor ADD CONSTRAINT FK_EDD478CCB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_pedido_proveedor DROP FOREIGN KEY FK_DF0CA032C9345071');
        $this->addSql('ALTER TABLE detalle_pedido_proveedor DROP FOREIGN KEY FK_DF0CA0327645698E');
        $this->addSql('ALTER TABLE pedido_proveedor DROP FOREIGN KEY FK_EDD478CCB305D73');
        $this->addSql('DROP TABLE detalle_pedido_proveedor');
        $this->addSql('DROP TABLE pedido_proveedor');
        $this->addSql('DROP TABLE proveedor');
    }
}
