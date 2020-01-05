<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200105001241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(15) NOT NULL, anne_de_naissance INT NOT NULL, description VARCHAR(255) NOT NULL, couleur_yeux VARCHAR(255) NOT NULL, couleur_cheveux VARCHAR(255) NOT NULL, citation VARCHAR(255) DEFAULT NULL, livres VARCHAR(255) DEFAULT NULL, films VARCHAR(255) NOT NULL, loisirs VARCHAR(255) NOT NULL, langue_parle VARCHAR(255) NOT NULL, jerecherche VARCHAR(255) NOT NULL, taille INT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur DROP pseudo, DROP anne_de_naissance, DROP description, DROP couleur_yeux, DROP couleur_cheveux, DROP citation, DROP livres, DROP films, DROP loisirs, DROP langue_parle, DROP jerecherche, DROP taille, DROP ville');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE voiture');
        $this->addSql('ALTER TABLE utilisateur ADD pseudo VARCHAR(15) NOT NULL COLLATE utf8mb4_unicode_ci, ADD anne_de_naissance INT NOT NULL, ADD description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD couleur_yeux VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD couleur_cheveux VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD citation VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD livres VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD films VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD loisirs VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD langue_parle VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD jerecherche VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD taille INT NOT NULL, ADD ville VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
