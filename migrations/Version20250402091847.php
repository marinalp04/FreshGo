<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402091847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detalle_pedido_cliente (id INT AUTO_INCREMENT NOT NULL, pedido_cliente_id INT NOT NULL, producto_id INT NOT NULL, cantidad DOUBLE PRECISION NOT NULL, precio_unitario DOUBLE PRECISION NOT NULL, INDEX IDX_A60A455A46B973C2 (pedido_cliente_id), INDEX IDX_A60A455A7645698E (producto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedido_cliente (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha DATETIME NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_9665134BDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detalle_pedido_cliente ADD CONSTRAINT FK_A60A455A46B973C2 FOREIGN KEY (pedido_cliente_id) REFERENCES pedido_cliente (id)');
        $this->addSql('ALTER TABLE detalle_pedido_cliente ADD CONSTRAINT FK_A60A455A7645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE pedido_cliente ADD CONSTRAINT FK_9665134BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE detalle_pedidos DROP FOREIGN KEY FK_2FC822024854653A');
        $this->addSql('ALTER TABLE detalle_pedidos DROP FOREIGN KEY FK_2FC822027645698E');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CEDB38439E');
        $this->addSql('DROP TABLE detalle_pedidos');
        $this->addSql('DROP TABLE pedido');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detalle_pedidos (id INT AUTO_INCREMENT NOT NULL, pedido_id INT NOT NULL, producto_id INT NOT NULL, cantidad INT NOT NULL, precio_unitario DOUBLE PRECISION NOT NULL, INDEX IDX_2FC822027645698E (producto_id), INDEX IDX_2FC822024854653A (pedido_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pedido (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha DATETIME NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_C4EC16CEDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE detalle_pedidos ADD CONSTRAINT FK_2FC822024854653A FOREIGN KEY (pedido_id) REFERENCES pedido (id)');
        $this->addSql('ALTER TABLE detalle_pedidos ADD CONSTRAINT FK_2FC822027645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE detalle_pedido_cliente DROP FOREIGN KEY FK_A60A455A46B973C2');
        $this->addSql('ALTER TABLE detalle_pedido_cliente DROP FOREIGN KEY FK_A60A455A7645698E');
        $this->addSql('ALTER TABLE pedido_cliente DROP FOREIGN KEY FK_9665134BDB38439E');
        $this->addSql('DROP TABLE detalle_pedido_cliente');
        $this->addSql('DROP TABLE pedido_cliente');
    }
}
