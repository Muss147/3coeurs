<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250502203346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, ADD deleted_user_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD CONSTRAINT FK_C82E74E104C1D3 FOREIGN KEY (created_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD CONSTRAINT FK_C82E74BB649746 FOREIGN KEY (updated_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD CONSTRAINT FK_C82E74FDE969F2 FOREIGN KEY (deleted_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C82E74E104C1D3 ON clients (created_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C82E74BB649746 ON clients (updated_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C82E74FDE969F2 ON clients (deleted_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, ADD deleted_user_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants ADD CONSTRAINT FK_23E2BAC3E104C1D3 FOREIGN KEY (created_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants ADD CONSTRAINT FK_23E2BAC3BB649746 FOREIGN KEY (updated_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants ADD CONSTRAINT FK_23E2BAC3FDE969F2 FOREIGN KEY (deleted_user_id) REFERENCES users (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_23E2BAC3E104C1D3 ON enfants (created_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_23E2BAC3BB649746 ON enfants (updated_user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_23E2BAC3FDE969F2 ON enfants (deleted_user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants DROP FOREIGN KEY FK_23E2BAC3E104C1D3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants DROP FOREIGN KEY FK_23E2BAC3BB649746
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants DROP FOREIGN KEY FK_23E2BAC3FDE969F2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_23E2BAC3E104C1D3 ON enfants
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_23E2BAC3BB649746 ON enfants
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_23E2BAC3FDE969F2 ON enfants
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enfants DROP created_user_id, DROP updated_user_id, DROP deleted_user_id, DROP created_at, DROP updated_at, DROP deleted_at
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP FOREIGN KEY FK_C82E74E104C1D3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP FOREIGN KEY FK_C82E74BB649746
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP FOREIGN KEY FK_C82E74FDE969F2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_C82E74E104C1D3 ON clients
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_C82E74BB649746 ON clients
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_C82E74FDE969F2 ON clients
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients DROP created_user_id, DROP updated_user_id, DROP deleted_user_id, DROP created_at, DROP updated_at, DROP deleted_at
        SQL);
    }
}
