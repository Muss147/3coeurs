<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250502204111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, created_user_id INT DEFAULT NULL, updated_user_id INT DEFAULT NULL, deleted_user_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, couleur VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_3AF34668E104C1D3 (created_user_id), INDEX IDX_3AF34668BB649746 (updated_user_id), INDEX IDX_3AF34668FDE969F2 (deleted_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories ADD CONSTRAINT FK_3AF34668E104C1D3 FOREIGN KEY (created_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories ADD CONSTRAINT FK_3AF34668BB649746 FOREIGN KEY (updated_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories ADD CONSTRAINT FK_3AF34668FDE969F2 FOREIGN KEY (deleted_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP FOREIGN KEY FK_C82E74BCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD CONSTRAINT FK_C82E74BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP FOREIGN KEY FK_C82E74BCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668E104C1D3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668BB649746
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668FDE969F2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categories
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP FOREIGN KEY FK_C82E74BCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD CONSTRAINT FK_C82E74BCF5E72D FOREIGN KEY (categorie_id) REFERENCES parametres (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
    }
}
