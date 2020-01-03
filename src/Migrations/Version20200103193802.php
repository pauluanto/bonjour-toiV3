<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103193802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voiture ADD description VARCHAR(255) NOT NULL, ADD couleur_yeux VARCHAR(255) NOT NULL, ADD couleur_cheveux VARCHAR(255) NOT NULL, ADD citation VARCHAR(255) DEFAULT NULL, ADD livres VARCHAR(255) DEFAULT NULL, ADD films VARCHAR(255) NOT NULL, ADD loisirs VARCHAR(255) NOT NULL, ADD langue_parle VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voiture DROP description, DROP couleur_yeux, DROP couleur_cheveux, DROP citation, DROP livres, DROP films, DROP loisirs, DROP langue_parle');
    }
}
