<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250502201240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD categorie_id INT NOT NULL, DROP adresse, DROP categorie
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD CONSTRAINT FK_C82E74BCF5E72D FOREIGN KEY (categorie_id) REFERENCES parametres (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C82E74BCF5E72D ON clients (categorie_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parametres ADD couleur VARCHAR(255) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE parametres DROP couleur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP FOREIGN KEY FK_C82E74BCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_C82E74BCF5E72D ON clients
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD adresse VARCHAR(255) DEFAULT NULL, ADD categorie VARCHAR(255) NOT NULL, DROP categorie_id
        SQL);
    }
}
