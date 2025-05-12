<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250511234757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE actions_autorisation DROP FOREIGN KEY FK_8F9CE87425DD318D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8F9CE87425DD318D ON actions_autorisation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE actions_autorisation CHANGE libelle_id action_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE actions_autorisation ADD CONSTRAINT FK_8F9CE8749D32F035 FOREIGN KEY (action_id) REFERENCES actions (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8F9CE8749D32F035 ON actions_autorisation (action_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE actions_autorisation DROP FOREIGN KEY FK_8F9CE8749D32F035
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8F9CE8749D32F035 ON actions_autorisation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE actions_autorisation CHANGE action_id libelle_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE actions_autorisation ADD CONSTRAINT FK_8F9CE87425DD318D FOREIGN KEY (libelle_id) REFERENCES actions (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8F9CE87425DD318D ON actions_autorisation (libelle_id)
        SQL);
    }
}
